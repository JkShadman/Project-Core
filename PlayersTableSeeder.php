echo "";<?php

namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Seeder;

class PlayersTableSeeder extends Seeder
{
    public function run()
    {
        $players = [
            // Goalkeepers
            ['name' => 'Alisson Becker', 'position' => 'Goalkeeper', 'team' => 'Liverpool', 'price' => 5.5, 'total_points' => 120, 'goals_scored' => 0, 'assists' => 0, 'clean_sheets' => 14, 'minutes_played' => 3240, 'influence' => 85],
            ['name' => 'Ederson', 'position' => 'Goalkeeper', 'team' => 'Man City', 'price' => 5.5, 'total_points' => 118, 'goals_scored' => 0, 'assists' => 1, 'clean_sheets' => 15, 'minutes_played' => 3240, 'influence' => 83],
            ['name' => 'Aaron Ramsdale', 'position' => 'Goalkeeper', 'team' => 'Arsenal', 'price' => 5.0, 'total_points' => 110, 'goals_scored' => 0, 'assists' => 0, 'clean_sheets' => 12, 'minutes_played' => 3060, 'influence' => 78],
            
            // Defenders
            ['name' => 'Trent Alexander-Arnold', 'position' => 'Defender', 'team' => 'Liverpool', 'price' => 7.5, 'total_points' => 180, 'goals_scored' => 2, 'assists' => 10, 'clean_sheets' => 14, 'minutes_played' => 2880, 'influence' => 92],
            ['name' => 'Andy Robertson', 'position' => 'Defender', 'team' => 'Liverpool', 'price' => 7.0, 'total_points' => 170, 'goals_scored' => 3, 'assists' => 8, 'clean_sheets' => 14, 'minutes_played' => 2970, 'influence' => 88],
            ['name' => 'Rúben Dias', 'position' => 'Defender', 'team' => 'Man City', 'price' => 6.0, 'total_points' => 165, 'goals_scored' => 1, 'assists' => 1, 'clean_sheets' => 15, 'minutes_played' => 2700, 'influence' => 85],
            ['name' => 'William Saliba', 'position' => 'Defender', 'team' => 'Arsenal', 'price' => 5.5, 'total_points' => 150, 'goals_scored' => 2, 'assists' => 1, 'clean_sheets' => 12, 'minutes_played' => 2880, 'influence' => 82],
            ['name' => 'Reece James', 'position' => 'Defender', 'team' => 'Chelsea', 'price' => 6.0, 'total_points' => 145, 'goals_scored' => 3, 'assists' => 5, 'clean_sheets' => 10, 'minutes_played' => 2520, 'influence' => 80],
            
            // Midfielders
            ['name' => 'Mohamed Salah', 'position' => 'Midfielder', 'team' => 'Liverpool', 'price' => 12.5, 'total_points' => 250, 'goals_scored' => 19, 'assists' => 12, 'clean_sheets' => 14, 'minutes_played' => 3060, 'influence' => 95],
            ['name' => 'Kevin De Bruyne', 'position' => 'Midfielder', 'team' => 'Man City', 'price' => 12.0, 'total_points' => 240, 'goals_scored' => 15, 'assists' => 15, 'clean_sheets' => 15, 'minutes_played' => 2880, 'influence' => 94],
            ['name' => 'Bukayo Saka', 'position' => 'Midfielder', 'team' => 'Arsenal', 'price' => 8.5, 'total_points' => 200, 'goals_scored' => 14, 'assists' => 11, 'clean_sheets' => 12, 'minutes_played' => 2970, 'influence' => 89],
            ['name' => 'Bruno Fernandes', 'position' => 'Midfielder', 'team' => 'Man Utd', 'price' => 10.0, 'total_points' => 195, 'goals_scored' => 12, 'assists' => 8, 'clean_sheets' => 8, 'minutes_played' => 3240, 'influence' => 87],
            ['name' => 'Martin Ødegaard', 'position' => 'Midfielder', 'team' => 'Arsenal', 'price' => 7.5, 'total_points' => 185, 'goals_scored' => 10, 'assists' => 9, 'clean_sheets' => 12, 'minutes_played' => 2880, 'influence' => 85],
            
            // Forwards
            ['name' => 'Erling Haaland', 'position' => 'Forward', 'team' => 'Man City', 'price' => 14.0, 'total_points' => 280, 'goals_scored' => 36, 'assists' => 8, 'clean_sheets' => 15, 'minutes_played' => 2700, 'influence' => 98],
            ['name' => 'Harry Kane', 'position' => 'Forward', 'team' => 'Tottenham', 'price' => 12.5, 'total_points' => 260, 'goals_scored' => 30, 'assists' => 5, 'clean_sheets' => 6, 'minutes_played' => 3060, 'influence' => 96],
            ['name' => 'Darwin Núñez', 'position' => 'Forward', 'team' => 'Liverpool', 'price' => 9.0, 'total_points' => 180, 'goals_scored' => 22, 'assists' => 4, 'clean_sheets' => 14, 'minutes_played' => 2340, 'influence' => 88],
            ['name' => 'Gabriel Jesus', 'position' => 'Forward', 'team' => 'Arsenal', 'price' => 8.0, 'total_points' => 170, 'goals_scored' => 18, 'assists' => 6, 'clean_sheets' => 12, 'minutes_played' => 2520, 'influence' => 85],
            ['name' => 'Marcus Rashford', 'position' => 'Forward', 'team' => 'Man Utd', 'price' => 9.5, 'total_points' => 165, 'goals_scored' => 17, 'assists' => 5, 'clean_sheets' => 8, 'minutes_played' => 2700, 'influence' => 83],
        ];

        foreach ($players as $player) {
            Player::create($player);
        }
    }
}
