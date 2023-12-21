<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowDetail extends Model
{
  use HasFactory;

  public $timestamps = false;

  protected $fillable = [
    'borrowed_from_date',
    'borrowed_to_date',
    'issued_by',
    'borrower_id',
  ];

  public function borrower()
  {
    return $this->morphTo();
  }
}
