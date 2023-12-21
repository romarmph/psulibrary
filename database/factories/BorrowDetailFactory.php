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
    $issued_at = $this->faker->dateTimeThisMonth();

    // Add 3 days to the issued_at
    $borrowed_to_date = (clone $issued_at)->modify('+3 days');

    return [
      'borrowed_from_date' => $issued_at,
      'borrowed_to_date' => $borrowed_to_date,
      'issued_by' => User::where('role', 'staff')->inRandomOrder()->first()->id,
      'borrower_id' => User::where('role', 'borrower')->inRandomOrder()->first()->id,
    ];
  }
}
