<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Club extends Model {
  protected $fillable=['name','short_name'];
  public function players(){ return $this->hasMany(Player::class); }
}