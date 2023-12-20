<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
  /**
   * The current password being used by the factory.
   */
  protected static ?string $password;
  protected int $staffCount = 0;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $year = fake()->numberBetween(18, 23);
    $number = str_pad(fake()->unique()->numberBetween(1, 500), 4, '0', STR_PAD_LEFT);
    $id_number = $year . '-UR-' . $number;

    $role = 'borrower';
    if ($this->staffCount < 10) {
      $role = 'staff';
      $this->staffCount++;
    }

    return [
      'first_name' => fake()->firstName(),
      'last_name' => fake()->lastName(),
      'id_number' => $id_number,
      'email' => fake()->unique()->safeEmail(),
      'phone_number' => fake()->unique()->phoneNumber(),
      'address' => fake()->address(),
      'photo_url' => fake()->imageUrl(),
      'password' => static::$password ??= Hash::make('password'),
      'role' => $role,
      'created_by' => $this->staffCount < 10 ? 1 : fake()->numberBetween(1, 10),
      'updated_by' => $this->staffCount < 10 ? 1 : fake()->numberBetween(1, 10),
      'deleted_by' => null,
      'remember_token' => Str::random(10),
    ];
  }
}
