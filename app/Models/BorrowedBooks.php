<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowedBooks extends Model
{
  use HasFactory;

  public $timestamps = false;

  protected $fillable = [
    'book_id',
    'borrow_detail_id',
    'quantity',
    'returned_at',
    'received_by',
  ];
}
