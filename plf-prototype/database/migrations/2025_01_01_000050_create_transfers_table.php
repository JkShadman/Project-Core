<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('transfers', function(Blueprint $table){
      $table->id();
      $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete();
      $table->foreignId('gameweek_id')->constrained('gameweeks')->cascadeOnDelete();
      $table->foreignId('out_player_id')->constrained('players');
      $table->foreignId('in_player_id')->constrained('players');
      $table->integer('points_cost')->default(0); // -4 etc
      $table->timestamps();
    });
  }
  public function down(): void {
    Schema::dropIfExists('transfers');
  }
};