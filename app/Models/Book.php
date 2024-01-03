<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Book extends Model implements Auditable
{
  use HasFactory;
  use SoftDeletes;
  use \OwenIt\Auditing\Auditable;

  protected $fillable = [
    'title',
    'isbn',
    'description',
    'category_id',
    'publisher_id',
    'published_at',
    'total_copies',
    'available_copies',
    'photo_url',
    'created_by',
    'updated_by',
  ];
}
