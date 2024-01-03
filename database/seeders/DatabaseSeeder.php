<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call(UserSeeder::class);
    $this->call(DepartmentSeeder::class);
    $this->call(CourseSeeder::class);
    \App\Models\User::factory(500)->create();
    $this->call(CategorySeeder::class);
    \App\Models\Publisher::factory(232)->create();
    $authors = \App\Models\Author::factory()->count(300)->create();
    \App\Models\Book::factory()->count(500)->create()->each(function ($book) use ($authors) {
      $book->authors()->attach(
        $authors->random(rand(1, 3))->pluck('id')->toArray()
      );
    });



    // \App\Models\User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);

  }
}
