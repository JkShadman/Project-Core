<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Chip extends Model {
  protected $fillable=['team_id','type','gameweek_id','played'];
}