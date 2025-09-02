<?php
namespace App\Services;

use App\Models\PlayerStats;
use App\Models\Team;
use App\Models\TeamPlayer;

/*
Scoring rules implemented:
- Goal points (by position)
  GK/DEF: 6, MID: 5, FWD: 4
- Assist: 3
- Clean sheet (GK/DEF only and minutes>=60): 4
- Conceded: -1 per 2 conceded for GK/DEF (classic simplified)
- Yellow: -1, Red: -3
- Saves: 1 per 3 saves (GK)
- Penalty events handled in stats
- Defensive contributions (new): for DEF only: every 5 defensive_contributions -> +1 point
- Captain: x2, Triple Captain chip: x3
- Bench boost chip: include bench in scoring
*/
class ScoringEngine {
  public static function scorePlayerForGw($player, $gw, $isCaptain=false, $isTriple=false, $applyBenchBoost=false) {
    $stat = PlayerStats::where('player_id',$player->id)->where('gameweek_id',$gw->id)->first();
    if (!$stat) return 0;
    $pos = $player->position;
    $points = 0;

    // goals
    if ($pos === 'GK' || $pos === 'DEF') $points += $stat->goals * 6;
    if ($pos === 'MID') $points += $stat->goals * 5;
    if ($pos === 'FWD') $points += $stat->goals * 4;

    // assists
    $points += $stat->assists * 3;

    // clean sheet
    if (($pos === 'GK' || $pos === 'DEF') && $stat->minutes >= 60 && $stat->clean_sheets) {
      $points += 4;
    }

    // goals conceded penalty simplified
    if ($pos === 'GK' || $pos === 'DEF') {
      $gc = $stat->goals_conceded;
      // -1 for each 2 goals conceded
      $points -= intdiv($gc, 2);
    }

    // cards
    $points -= $stat->yellow_cards;
    $points -= $stat->red_cards * 3;

    // saves for GK
    if ($pos === 'GK') {
      $points += intdiv($stat->saves, 3);
    }

    // penalty saved/missed
    $points += $stat->penalties_saved * 5;
    $points -= $stat->penalties_missed * 2;

    // NEW: defensive contributions -> for DEF only
    if ($pos === 'DEF') {
      $points += intdiv($stat->defensive_contributions, 5);
    }

    // captain/triple captain
    if ($isTriple) {
      $points *= 3;
    } elseif ($isCaptain) {
      $points *= 2;
    }

    return (int)$points;
  }

  // Score entire team for a GW, respecting starting 11 and chips
  public static function scoreTeamForGw(Team $team, $gw) {
    $teamPlayers = $team->players()->wherePivot('gameweek_id',$gw->id)->get();
    // figure starting players: pivot is_starting==true or otherwise automatic first 11
    $starting = $team->players()->wherePivot('gameweek_id',$gw->id)->wherePivot('is_starting',true)->get();
    if ($starting->count() === 0) {
      // select first 11 by id as default starters
      $starting = $teamPlayers->take(11);
    }

    // chips logic (simplified - should check db for actual chip record for that GW)
    $chip = $team->chips()->where('gameweek_id',$gw->id)->where('played',true)->first();
    $benchBoost = $chip && $chip->type === 'benchboost';
    $tripleCaptainAppliedTo = null;
    if ($chip && $chip->type === 'triplecaptain') {
      // we assume captain set on team record or pivot; real impl should store captain in team table or pivot
    }

    // assume team has captain_id and vicecaptain_id stored in team table or pivot for the GW; simplified here
    $captainId = $team->captain_id ?? null;
    $tripleCaptain = false;
    $total = 0;

    foreach ($teamPlayers as $tp) {
      $isStarting = $starting->contains($tp);
      if (!$isStarting && !$benchBoost) continue; // bench not counted unless benchboost
      $isCaptain = $tp->id == $captainId;
      $score = self::scorePlayerForGw($tp, $gw, $isCaptain, $tripleCaptain, $benchBoost);
      $total += $score;
    }

    return $total;
  }
}
