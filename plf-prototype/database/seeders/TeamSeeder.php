<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Team;
class TeamSeeder extends Seeder {
  public function run(): void {
    Team::create(['user_id'=>1,'name'=>'My Fantasy XI','budget'=>100.0]);
  }
}