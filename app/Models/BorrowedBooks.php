<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowedBooks extends Model
{
  use HasFactory;

  protected $fillable = [
    'book_id',
    'borrower_detail_id',
    'returned_at',
    'received_by',
  ];
}
