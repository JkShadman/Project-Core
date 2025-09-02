<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('player_stats', function(Blueprint $table){
      $table->id();
      $table->foreignId('player_id')->constrained('players')->cascadeOnDelete();
      $table->foreignId('gameweek_id')->constrained('gameweeks')->cascadeOnDelete();
      $table->integer('goals')->default(0);
      $table->integer('assists')->default(0);
      $table->integer('clean_sheets')->default(0);
      $table->integer('goals_conceded')->default(0);
      $table->integer('yellow_cards')->default(0);
      $table->integer('red_cards')->default(0);
      $table->integer('minutes')->default(0);
      $table->integer('saves')->default(0); // for GKs
      $table->integer('penalties_saved')->default(0);
      $table->integer('penalties_missed')->default(0);
      $table->integer('defensive_contributions')->default(0); // NEW: tackles+blocks+interceptions etc
      $table->timestamps();
      $table->unique(['player_id','gameweek_id']);
    });
  }
  public function down(): void {
    Schema::dropIfExists('player_stats');
  }
};