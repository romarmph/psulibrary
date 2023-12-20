<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BorrowDetail;
use App\Models\Book;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BorrowDetail>
 */
class BorrowDetailFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'borrowed_from_date' => $this->faker->dateTime(),
      'borrowed_to_date' => $this->faker->dateTimeInInterval('3 days'),
      'issued_by' => User::where('role', 'staff')->inRandomOrder()->first()->id,
      'issued_at' => $this->faker->dateTime(),
      'borrower_id' => User::where('role', 'borrower')->inRandomOrder()->first()->id,
    ];
  }
}
