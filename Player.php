<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'team',
        'price',
        'total_points',
        'goals_scored',
        'assists',
        'clean_sheets',
        'minutes_played',
        'influence',
        'photo_url'
    ];

    protected $casts = [
        'price' => 'decimal:1',
        'total_points' => 'integer',
        'goals_scored' => 'integer',
        'assists' => 'integer',
        'clean_sheets' => 'integer',
        'minutes_played' => 'integer',
        'influence' => 'integer',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_players')
                    ->withPivot('is_captain', 'is_vice_captain')
                    ->withTimestamps();
    }
}
