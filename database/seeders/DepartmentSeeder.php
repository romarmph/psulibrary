<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $departments = [
      [
        'name' => 'IT Department',
      ],
      [
        'name' => 'Mathematics Department',
      ],
      [
        'name' => 'Engineering Department',
      ],
      [
        'name' => 'Architecture Department',
      ],
      [
        'name' => 'Education Department',
      ],
      [
        'name' => 'English Language Department',
      ],
    ];

    foreach ($departments as $department) {
      \App\Models\Department::create($department);
    }
  }
}
