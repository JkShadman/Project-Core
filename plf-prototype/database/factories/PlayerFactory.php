<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class PlayerFactory extends Factory {
  public function definition(): array {
    $pos = $this->faker->randomElement(['GK','DEF','MID','FWD']);
    return [
      'first_name'=>$this->faker->firstName,
      'second_name'=>$this->faker->lastName,
      'name'=>$this->faker->name,
      'position'=>$pos,
      'club_id'=>1,
      'price'=>round($this->faker->randomFloat(1,4.0,14.0),1),
    ];
  }
}
