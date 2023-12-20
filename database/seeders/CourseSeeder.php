<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $course = [
      [
        'name' => 'BS Information Technology',
        'code' => 'BSIT',
        'department_id' => 1,
      ],
      [
        'name' => 'BS Mechanical Engineering',
        'code' => 'BSME',
        'department_id' => 3,
      ],
      [
        'name' => 'BS Electrical Engineering',
        'code' => 'BSEE',
        'department_id' => 3,
      ],
      [
        'name' => 'BS Civil Engineering',
        'code' => 'BSCE',
        'department_id' => 3,
      ],
      [
        'name' => 'BS Computer Engineering',
        'code' => 'BSCoE',
        'department_id' => 3,
      ],
      [
        'name' => 'BS Mathematics',
        'code' => 'BS Math',
        'department_id' => 2,
      ],
      [
        'name' => 'BS Architecture',
        'code' => 'BSA',
        'department_id' => 4,
      ],
      [
        'name' => 'AB English Language',
        'code' => 'AB English',
        'department_id' => 6,
      ],
      [
        'name' => 'Bachelor of Secondary Education',
        'code' => 'BSEd',
        'department_id' => 5,
      ],
      [
        'name' => 'Bachelor of Early Childhood Education',
        'code' => 'BECEd',
        'department_id' => 5,
      ],
    ];
  }
}
