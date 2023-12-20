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
    $this->call(DepartmentSeeder::class);
    $this->call(CourseSeeder::class);
    \App\Models\User::factory(500)->create();
    $this->call(CategorySeeder::class);
    \App\Models\Publisher::factory(500)->create();
    \App\Models\Author::factory(1200)->create();
    \App\Models\Book::factory(2000)->create();



    // \App\Models\User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);

  }
}
