<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Player;
use App\Models\Gameweek;
use App\Models\TeamPlayer;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller {
  const BUDGET = 100.0;
  const SQUAD_SIZE = 15;
  const STARTING = 11;
  const POSITION_REQUIREMENTS = ['GK'=>2,'DEF'=>5,'MID'=>5,'FWD'=>3];
  const MAX_PER_CLUB = 3;

  private function getTeam() {
    $id = session('user_id',1);
    return Team::firstOrCreate(['user_id'=>$id], ['budget'=>self::BUDGET]);
  }

  private function currentGw() {
    return Gameweek::orderBy('number')->first() ?? Gameweek::create(['name'=>'GW1','number'=>1,'deadline_at'=>now()->addDay()]);
  }

  public function show() {
    $team = $this->getTeam();
    $gw = $this->currentGw();
    $players = $team->players()->wherePivot('gameweek_id',$gw->id)->get();
    return view('team.show', compact('team','players','gw'));
  }

  public function selectForm() {
    $team = $this->getTeam();
    $gw = $this->currentGw();
    $players = Player::with('club')->orderBy('position')->orderByDesc('price')->get();
    $existing = $team->players()->wherePivot('gameweek_id',$gw->id)->pluck('players.id')->toArray();
    return view('team.select', compact('players','existing','gw'));
  }

  public function saveSelection(Request $req) {
    $team = $this->getTeam();
    $gw = $this->currentGw();

    $ids = collect($req->get('player_ids',[]))->map(fn($i)=>(int)$i)->unique()->values();
    if ($ids->count() !== self::SQUAD_SIZE) {
      return back()->withErrors(['Squad must contain exactly '.self::SQUAD_SIZE.' players.']);
    }

    $players = Player::whereIn('id',$ids)->get();
    $spent = $players->sum('price');
    if ($spent > self::BUDGET) {
      return back()->withErrors(['Budget exceeded: spent '.$spent.' > '.self::BUDGET]);
    }

    // position counts
    $posCounts = $players->groupBy('position')->map->count()->toArray();
    foreach (self::POSITION_REQUIREMENTS as $pos=>$reqCount) {
      if (($posCounts[$pos] ?? 0) !== $reqCount) {
        return back()->withErrors(["Position constraint failed: $pos must be exactly $reqCount"]);
      }
    }

    // club constraint: max 3 per real club
    $clubCounts = $players->groupBy(fn($p)=>$p->club_id)->map->count()->toArray();
    foreach ($clubCounts as $clubId => $count) {
      if ($count > self::MAX_PER_CLUB) {
        return back()->withErrors(["Club limit exceeded: max ".self::MAX_PER_CLUB." players per club (club_id:$clubId)"]);
      }
    }

    DB::transaction(function() use ($team,$gw,$ids){
      TeamPlayer::where('team_id',$team->id)->where('gameweek_id',$gw->id)->delete();
      foreach ($ids as $pid) {
        TeamPlayer::create(['team_id'=>$team->id,'player_id'=>$pid,'gameweek_id'=>$gw->id,'is_squad'=>true,'is_starting'=>false]);
      }
    });

    return redirect()->route('team.show')->with('ok','Team saved for '.$gw->name);
  }

  // set captain and vice-captain; store in team table as columns (for prototype)
  public function setCaptains(Request $req) {
    $team = $this->getTeam();
    $gw = $this->currentGw();
    $captain = (int)$req->captain;
    $vice = (int)$req->vice_captain;
    // basic validations: both must be in squad
    $ownedIds = $team->players()->wherePivot('gameweek_id',$gw->id)->pluck('players.id')->toArray();
    if (!in_array($captain,$ownedIds) || !in_array($vice,$ownedIds)) {
      return back()->withErrors(['Captain/vice must be players you own.']);
    }
    $team->captain_id = $captain;
    $team->vice_captain_id = $vice;
    $team->save();
    return back()->with('ok','Captain & Vice set.');
  }
}
