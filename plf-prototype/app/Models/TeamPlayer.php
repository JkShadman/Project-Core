<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TeamPlayer extends Model {
  protected $table='team_players';
  protected $fillable=['team_id','player_id','gameweek_id','is_squad','is_starting'];
}