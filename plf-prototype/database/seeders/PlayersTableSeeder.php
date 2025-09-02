<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Player;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $players = [
            [
                'first_name' => 'Mohamed',
                'last_name' => 'Salah',
                'display_name' => 'Mohamed Salah',
                'team' => 'Liverpool',
                'position' => 'Midfielder',
                'price' => 14.0,
                'total_points' => 200,
                'goals_scored' => 20,
                'assists' => 10,
                'clean_sheets' => 5,
                'goals_conceded' => 0,
                'own_goals' => 0,
                'penalties_saved' => 0,
                'penalties_missed' => 1,
                'yellow_cards' => 2,
                'red_cards' => 0,
                'saves' => 0,
                'bonus_points' => 15,
                'defensive_contributions' => 0,
                'injury_status' => null,
                'injury_return_date' => null,
                'is_available' => true,
            ],
            // Add more players as needed
        ];

        foreach ($players as $player) {
            Player::create($player);
        }
    }
}
