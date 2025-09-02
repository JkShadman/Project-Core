<?php
namespace App\Http\Controllers;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller {
  public function index(Request $req) {
    $q = Player::with('club');
    if ($req->filled('q')) {
      $q->where('name','like','%'.$req->q.'%');
    }
    if ($req->filled('position')) {
      $q->where('position',$req->position);
    }
    $players = $q->paginate(25);
    return view('players.index', compact('players'));
  }

  public function show(Player $player) {
    return view('players.show', compact('player'));
  }
}