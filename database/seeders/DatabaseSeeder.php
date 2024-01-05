<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call(DepartmentSeeder::class);
    $this->call(CourseSeeder::class);
    $this->call(UserSeeder::class);
    \App\Models\User::factory(500)->create();
    $this->call(CategorySeeder::class);
    \App\Models\Publisher::factory(50)->create();
    $authors = \App\Models\Author::factory()->count(200)->create();
    \App\Models\Book::factory()->count(500)->create()->each(function ($book) use ($authors) {
      $book->authors()->attach(
        $authors->random(rand(1, 3))->pluck('id')->toArray()
      );
    });

    \App\Models\User::factory()->create([
      'id' => 601,
      'first_name' => 'Tony',
      'last_name' => 'Spork',
      'id_number' => '20-UR-601',
      'email' => 'tony.sporke@example.com',
      'phone_number' => '098167235',
      'address' => '123 Main St',
      'photo_url' => 'https://example.com/john_doe.jpg',
      'password' => Hash::make('password'),
      'role' => 'borrower',
      'course_id' => 1,
      'created_by' => 1,
      'updated_by' => 1,
      'created_at' => now(),
      'updated_at' => now(),
    ]);



    // \App\Models\User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);

  }
}
