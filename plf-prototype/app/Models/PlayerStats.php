<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PlayerStats extends Model {
  protected $fillable=['player_id','gameweek_id','goals','assists','clean_sheets','goals_conceded','yellow_cards','red_cards','minutes','saves','penalties_saved','penalties_missed','defensive_contributions'];
  public function player(){ return $this->belongsTo(Player::class); }
  public function gw(){ return $this->belongsTo(Gameweek::class,'gameweek_id'); }
}