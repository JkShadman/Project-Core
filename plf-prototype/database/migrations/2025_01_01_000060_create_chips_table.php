<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('chips', function(Blueprint $table){
      $table->id();
      $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete();
      $table->enum('type', ['wildcard','freehit','benchboost','triplecaptain']);
      $table->unsignedInteger('gameweek_id')->nullable();
      $table->boolean('played')->default(false);
      $table->timestamps();
    });
  }
  public function down(): void {
    Schema::dropIfExists('chips');
  }
};