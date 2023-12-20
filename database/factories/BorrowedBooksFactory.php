<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BorrowDetail;
use App\Models\Book;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BorrowedBooks>
 */
class BorrowedBooksFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'borrow_detail_id' => BorrowDetail::factory(),
      'book_id' => Book::factory(),
      'quantity' => $this->faker->randomDigitNotNull,
      'returned_at' => $this->faker->dateTime(),
      'received_by' => User::where('role', 'staff')->inRandomOrder()->first()->id,
    ];
  }
}
