<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('gameweeks', function(Blueprint $table){
      $table->id();
      $table->string('name')->index(); // "GW1", "GW2"
      $table->unsignedInteger('number')->unique();
      $table->dateTime('deadline_at')->nullable();
      $table->timestamps();
    });
  }
  public function down(): void {
    Schema::dropIfExists('gameweeks');
  }
};