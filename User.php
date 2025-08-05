<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'budget',
        'transfers_remaining',
        'total_points',
        'gameweek_points',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'budget' => 'decimal:1',
        'transfers_remaining' => 'integer',
        'total_points' => 'integer',
        'gameweek_points' => 'integer',
    ];

    public function players()
    {
        return $this->belongsToMany(Player::class, 'user_players')
                    ->withPivot('is_captain', 'is_vice_captain')
                    ->withTimestamps();
    }

    public function getTeamValue()
    {
        return $this->players->sum('price');
    }

    public function getRemainingBudget()
    {
        return $this->budget - $this->getTeamValue();
    }
}
