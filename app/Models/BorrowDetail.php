<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowDetail extends Model
{
  use HasFactory;

  protected $fillable = [
    'borrowed_from_date',
    'borrowed_to_date',
    'issued_by',
    'issued_at',
    'borrower_id',
    'borower_type',
    'quantity',
  ];

  public function borrower()
  {
    return $this->morphTo();
  }
}
