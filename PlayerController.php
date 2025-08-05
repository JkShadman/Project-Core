<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::orderBy('total_points', 'desc')->get();
        return view('players.index', compact('players'));
    }

    public function show(Player $player)
    {
        return view('players.show', compact('player'));
    }

    public function apiIndex()
    {
        $players = Player::all();
        return response()->json($players);
    }

    public function filterByPosition(Request $request)
    {
        $position = $request->get('position');
        $players = Player::where('position', $position)->get();
        return response()->json($players);
    }

    public function filterByTeam(Request $request)
    {
        $team = $request->get('team');
        $players = Player::where('team', $team)->get();
        return response()->json($players);
    }
}
