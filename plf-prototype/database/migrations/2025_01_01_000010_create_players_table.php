<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('players', function(Blueprint $table){
      $table->id();
      $table->string('first_name')->nullable();
      $table->string('second_name');
      $table->string('name')->index(); // full name convenience
      $table->enum('position', ['GK','DEF','MID','FWD']);
      $table->foreignId('club_id')->constrained('clubs')->cascadeOnDelete();
      $table->decimal('price',6,1)->default(4.0);
      $table->boolean('is_injured')->default(false); // or severity/injury_level link
      $table->enum('injury_level', ['none','yellow','orange','red'])->default('none'); // for UI warnings
      $table->integer('minutes')->default(0);
      $table->timestamps();
    });
  }
  public function down(): void {
    Schema::dropIfExists('players');
  }
};