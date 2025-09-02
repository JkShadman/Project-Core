<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('injuries', function(Blueprint $table){
      $table->id();
      $table->foreignId('player_id')->constrained('players')->cascadeOnDelete();
      $table->enum('level', ['yellow','orange','red']);
      $table->text('note')->nullable();
      $table->timestamps();
    });
  }
  public function down(): void {
    Schema::dropIfExists('injuries');
  }
};