<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowRequest extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'status',
    'borrow_date',
    'return_date',
  ];
}
