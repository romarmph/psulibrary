<?php

namespace App\Models;

use Carbon\Carbon;
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

  public function setPublishedAtAttribute($value)
  {
    $this->attributes['published_at'] = Carbon::createFromFormat('Y', $value)->format('Y-m-d');
  }

  public function authors()
  {
    return $this->belongsToMany('App\Models\Author', 'book_authors');
  }
}
