<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $categories = [
      [
        'name' => 'General Works',
        'dewey' => '000-099',
      ],
      [
        'name' => 'Philosophy',
        'dewey' => '100-199',
      ],
      [
        'name' => 'Religion',
        'dewey' => '200-299',
      ],
      [
        'name' => 'Sociology',
        'dewey' => '300-399',
      ],
      [
        'name' => 'Language',
        'dewey' => '400-499',
      ],
      [
        'name' => 'Science',
        'dewey' => '500-599',
      ],
      [
        'name' => 'Applied Science',
        'dewey' => '600-699',
      ],
      [
        'name' => 'Arts',
        'dewey' => '700-799',
      ],
      [
        'name' => 'Literature',
        'dewey' => '800-899',
      ],
      [
        'name' => 'History, Travel, Biography',
        'dewey' => '900-999',
      ],
    ];

    foreach ($categories as $category) {
      \App\Models\Category::create($category);
    }
  }
}
