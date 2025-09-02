<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Gameweek;
use App\Models\Player;
use App\Models\TeamPlayer;
use App\Models\Transfer;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller {
  const FREE_TRANSFERS = 1;
  const EXTRA_COST = 4;
  const BUDGET = 100.0;

  private function getTeam(){ $id=session('user_id',1); return Team::firstOrCreate(['user_id'=>$id],['budget'=>self::BUDGET]); }
  private function currentGw(){ return Gameweek::orderBy('number')->first() ?? Gameweek::create(['name'=>'GW1','number'=>1,'deadline_at'=>now()->addDay()]); }

  public function index(){
    $team = $this->getTeam();
    $gw = $this->currentGw();
    $current = $team->players()->wherePivot('gameweek_id',$gw->id)->get();
    $market = Player::with('club')->orderBy('position')->orderByDesc('price')->get();
    $made = Transfer::where('team_id',$team->id)->where('gameweek_id',$gw->id)->count();
    return view('transfers.index', compact('team','current','market','made','gw'));
  }

  public function swap(Request $req) {
    $team = $this->getTeam();
    $gw = $this->currentGw();
    if ($gw->isLocked()) return back()->withErrors(['Transfers locked for this gameweek.']);
    $out = (int)$req->out_player_id;
    $in = (int)$req->in_player_id;
    if ($out === $in) return back()->withErrors(['Choose different players.']);
    $current = $team->players()->wherePivot('gameweek_id',$gw->id)->get();
    if (!$current->pluck('id')->contains($out)) return back()->withErrors(['OUT player not in your squad.']);
    $inPlayer = Player::findOrFail($in);
    $outPlayer = Player::findOrFail($out);
    // same position rule for simple swaps:
    if ($inPlayer->position !== $outPlayer->position) return back()->withErrors(['Swaps must be same position in prototype.']);

    // budget check
    $spent = $current->sum('price') - $outPlayer->price + $inPlayer->price;
    if ($spent > self::BUDGET) return back()->withErrors(['Budget would be exceeded.']);

    // already own
    if ($current->pluck('id')->contains($in)) return back()->withErrors(['You already own the incoming player.']);

    // max per club check after swap
    $futurePlayers = $current->where('id','!=',$out)->push($inPlayer);
    $clubCounts = $futurePlayers->groupBy('club_id')->map->count();
    foreach ($clubCounts as $clubId => $count) {
      if ($count > 3) return back()->withErrors(['Club maximum (3) would be exceeded.']);
    }

    $made = Transfer::where('team_id',$team->id)->where('gameweek_id',$gw->id)->count();
    $cost = ($made >= self::FREE_TRANSFERS) ? self::EXTRA_COST : 0;

    DB::transaction(function() use ($team,$gw,$out,$in,$cost){
      $tp = TeamPlayer::where('team_id',$team->id)->where('gameweek_id',$gw->id)->where('player_id',$out)->firstOrFail();
      $tp->player_id = $in;
      $tp->save();

      Transfer::create(['team_id'=>$team->id,'gameweek_id'=>$gw->id,'out_player_id'=>$out,'in_player_id'=>$in,'points_cost'=>$cost]);

      if ($cost) {
        $team->points -= $cost;
        $team->save();
      }
    });

    return back()->with('ok','Transfer made'.($cost ? " (-{$cost} pts)" : ''));
  }
}