<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GameweekSeeder extends Seeder
{
    public function run(): void
    {
        // Seed 38 gameweeks
        for ($i = 1; $i <= 38; $i++) {
            \DB::table('gameweeks')->insert([
                'id' => $i,
                'name' => 'Gameweek '.$i,
                'number' => $i,            // <-- added this line
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}