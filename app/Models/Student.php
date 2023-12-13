<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  use HasFactory;

  protected $fillable = [
    'student_number',
    'first_name',
    'last_name',
    'course_id',
    'address',
    'contact_number',
    'photoUrl',
    'password',
  ];
}
