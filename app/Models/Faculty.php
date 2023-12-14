<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
  use HasFactory;

  protected $fillable = [
    'employee_number',
    'first_name',
    'last_name',
    'department_id',
    'photo_url',
    'password',
  ];

  public function borrow()
  {
    return $this->morphMany(BorrowDetail::class, 'borrower');
  }
}
