<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Player extends Model {
  protected $fillable=['first_name','second_name','name','position','club_id','price','is_injured','injury_level','minutes'];
  public function club(){ return $this->belongsTo(Club::class); }
  public function stats(){ return $this->hasMany(PlayerStats::class); }
  public function injuries(){ return $this->hasMany(Injury::class); }
}
