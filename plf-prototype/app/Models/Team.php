<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Team extends Model {
  protected $fillable=['user_id','name','budget','points'];
  public function players(){ return $this->belongsToMany(Player::class,'team_players')->withPivot('gameweek_id','is_squad','is_starting')->withTimestamps(); }
  public function chips(){ return $this->hasMany(Chip::class); }
  public function transfers(){ return $this->hasMany(Transfer::class); }
}