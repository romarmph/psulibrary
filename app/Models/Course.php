<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'department_id',
    'code',
  ];

  public function courses()
  {
    return $this->hasMany('App\Models\Course', 'id');
  }
}
