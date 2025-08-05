<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $team = $user->players()->with('players')->get();
        $remainingBudget = $user->getRemainingBudget();
        $teamValue = $user->getTeamValue();
        
        return view('team.index', compact('user', 'team', 'remainingBudget', 'teamValue'));
    }

    public function create()
    {
        $user = Auth::user();
        $players = Player::all();
        $selectedPlayers = $user->players->pluck('id')->toArray();
        
        return view('team.create', compact('players', 'selectedPlayers', 'user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $selectedPlayers = $request->input('players', []);
        
        $validationResult = $this->validateTeamSelection($user, $selectedPlayers);
        
        if (!$validationResult['valid']) {
            return redirect()->back()->with('error', $validationResult['message']);
        }

        $user->players()->sync($selectedPlayers);
        
        return redirect()->route('team.index')->with('success', 'Team created successfully!');
    }

    public function transfers()
    {
        $user = Auth::user();
        $players = Player::all();
        $currentTeam = $user->players;
        
        return view('team.transfers', compact('user', 'players', 'currentTeam'));
    }

    public function processTransfers(Request $request)
    {
        $user = Auth::user();
        
        if ($user->transfers_remaining <= 0) {
            return redirect()->back()->with('error', 'No transfers remaining for this gameweek.');
        }

        $transfers = $request->input('transfers', []);
        
        foreach ($transfers as $transfer) {
            $outPlayerId = $transfer['out'];
            $inPlayerId = $transfer['in'];
            
            $user->players()->detach($outPlayerId);
            $user->players()->attach($inPlayerId);
        }

        $user->decrement('transfers_remaining');
        
        return redirect()->route('team.index')->with('success', 'Transfers completed successfully!');
    }

    private function validateTeamSelection($user, $selectedPlayers)
    {
        if (count($selectedPlayers) !== 11) {
            return ['valid' => false, 'message' => 'You must select exactly 11 players.'];
        }

        $players = Player::whereIn('id', $selectedPlayers)->get();
        
        $positions = $players->groupBy('position')->map->count();
        
        $requiredPositions = [
            'Goalkeeper' => 1,
            'Defender' => 3,
            'Midfielder' => 4,
            'Forward' => 3
        ];

        foreach ($requiredPositions as $position => $requiredCount) {
            if (($positions[$position] ?? 0) < $requiredCount) {
                return ['valid' => false, 'message' => "You must select at least {$requiredCount} {$position}(s)."];
            }
        }

        $totalCost = $players->sum('price');
        if ($totalCost > $user->budget) {
            return ['valid' => false, 'message' => 'Team cost exceeds your budget.'];
        }

        $teams = $players->groupBy('team')->map->count();
        if ($teams->max() > 3) {
            return ['valid' => false, 'message' => 'You cannot select more than 3 players from the same team.'];
        }

        return ['valid' => true];
    }
}
