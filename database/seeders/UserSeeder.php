<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    User::create([
      'first_name' => 'John',
      'last_name' => 'Doe',
      'id_number' => '20-UR-1234',
      'email' => 'john.doe@example.com',
      'phone_number' => '1234567890',
      'address' => '123 Main St',
      'photo_url' => 'https://example.com/john_doe.jpg',
      'password' => Hash::make('password'),
      'type' => 'staff',
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => now(),
      'updated_at' => now(),

      // 'deleted_by' => 'Seeder', // You probably don't want to set this for a new user
      // 'leted_at' => now(), // You probably don't want to set this for a new user
    ]);
  }
}
