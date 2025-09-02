<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PlayerStats;
use App\Models\Gameweek;

class AdminController extends Controller {
  public function dashboard() {
    $gws = Gameweek::orderBy('number')->get();
    return view('admin.dashboard', compact('gws'));
  }

  // Admin posts player stats for a GW to compute points
  public function updateStats(Request $req) {
    // Expect array of stats: stats[player_id] => [...fields...]
    $gw = Gameweek::findOrFail($req->gameweek_id);
    $data = $req->input('stats', []);
    foreach ($data as $playerId => $stat) {
      PlayerStats::updateOrCreate(['player_id'=>$playerId,'gameweek_id'=>$gw->id], $stat);
    }
    return back()->with('ok','Stats updated for '.$gw->name);
  }
}