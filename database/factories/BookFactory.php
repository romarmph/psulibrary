<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $copies = $this->faker->numberBetween(10, 50);
    return [
      'title' => $this->faker->words(3, true),
      'isbn' => $this->faker->isbn13(),
      'description' => $this->faker->sentence(10),
      'category_id' => $this->faker->numberBetween(1, 10),
      'publisher_id' => $this->faker->numberBetween(1, 50),
      'published_at' => $this->faker->year('now'),
      'total_copies' => $copies,
      'available_copies' => $copies,
      'photo_url' => $this->faker->imageUrl(),
      'created_by' => $this->faker->numberBetween(1, 10),
      'updated_by' => $this->faker->numberBetween(1, 10),
    ];
  }
}
