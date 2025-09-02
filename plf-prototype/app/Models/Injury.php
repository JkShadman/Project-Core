<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Injury extends Model {
  protected $fillable=['player_id','level','note'];
  public function player(){ return $this->belongsTo(Player::class); }
}