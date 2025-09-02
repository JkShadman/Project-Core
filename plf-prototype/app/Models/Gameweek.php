<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Gameweek extends Model {
  protected $fillable=['name','number','deadline_at'];
  protected $dates=['deadline_at'];
  public function isLocked(){ return $this->deadline_at && now()->greaterThanOrEqualTo($this->deadline_at); }
}