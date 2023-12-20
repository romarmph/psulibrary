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
    return [
      'title' => $this->faker->sentence(1),
      'isbn' => $this->faker->isbn13(),
      'description' => $this->faker->sentence(10),
      'category_id' => $this->faker->numberBetween(1, 10),
      'publisher_id' => $this->faker->numberBetween(1, 10),
      'published_at' => $this->faker->date(),
      'total_copies' => $this->faker->numberBetween(10, 50),
      'available_copies' => $this->faker->numberBetween(1, 10),
      'photo_url' => 'https://picsum.photos/500',
      'created_by' => $this->faker->numberBetween(1, 10),
      'updated_by' => $this->faker->numberBetween(1, 10),
      'deleted_by' => null,
    ];
  }
}
