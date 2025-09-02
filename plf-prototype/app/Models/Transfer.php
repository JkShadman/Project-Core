<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Transfer extends Model {
  protected $fillable=['team_id','gameweek_id','out_player_id','in_player_id','points_cost'];
}