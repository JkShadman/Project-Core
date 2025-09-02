<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Chip;
use App\Models\Gameweek;

class ChipController extends Controller {
  private function getTeam(){ $id=session('user_id',1); return Team::firstOrCreate(['user_id'=>$id],['budget'=>100.0]); }
  private function currentGw(){ return Gameweek::orderBy('number')->first() ?? Gameweek::create(['name'=>'GW1','number'=>1,'deadline_at'=>now()->addDay()]); }

  public function index(){
    $team = $this->getTeam();
    $gw = $this->currentGw();
    return view('chips.index', compact('team','gw'));
  }

  public function play(Request $req){
    $team = $this->getTeam();
    $gw = $this->currentGw();
    $type = $req->type;
    if (!in_array($type,['wildcard','freehit','benchboost','triplecaptain'])) {
      return back()->withErrors(['Invalid chip type']);
    }

    // check not already played
    $existing = $team->chips()->where('type',$type)->first();
    if ($existing && $existing->played) return back()->withErrors(['Chip already used.']);

    // apply chip (prototype: record chosen chip with gw)
    $chip = $existing ?? new Chip(['team_id'=>$team->id,'type'=>$type]);
    $chip->gameweek_id = $gw->id;
    $chip->played = true;
    $chip->save();

    return back()->with('ok','Chip '.$type.' scheduled for '.$gw->name);
  }
}