<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('team_players', function(Blueprint $table){
      $table->id();
      $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete();
      $table->foreignId('player_id')->constrained('players')->cascadeOnDelete();
      $table->foreignId('gameweek_id')->constrained('gameweeks')->cascadeOnDelete();
      $table->boolean('is_squad')->default(true); // part of 15-man squad snapshot
      $table->boolean('is_starting')->default(false); // used for blank/bank/bench
      $table->timestamps();
      $table->unique(['team_id','player_id','gameweek_id']);
    });
  }
  public function down(): void {
    Schema::dropIfExists('team_players');
  }
};