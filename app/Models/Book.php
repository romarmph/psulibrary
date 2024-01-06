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

  // public function setPublishedAtAttribute($value)
  // {
  //   $this->attributes['published_at'] = Carbon::createFromFormat('Y', $value)->format('Y-m-d');
  // }

  public function scopeSearch($query, $search)
  {
    return $query->where('title', 'like', '%' . $search . '%')
      ->orWhere('isbn', 'like', '%' . $search . '%')
      ->orWhereHas('publisher', function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%');
      })
      ->orWhereHas('category', function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%');
      })
      ->orWhereHas('authors', function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%');
      });
  }


  public function authors()
  {
    return $this->belongsToMany('App\Models\Author', 'book_authors');
  }

  public function category()
  {
    return $this->belongsTo('App\Models\Category', 'category_id');
  }

  public function publisher()
  {
    return $this->belongsTo('App\Models\Publisher', 'publisher_id');
  }

  public function users()
  {
    return $this->belongsToMany('App\Models\User', 'cart', 'book_id', 'user_id');
  }
}
