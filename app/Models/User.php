<?php

namespace App\Models;

use App\Enums\UserRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use OwenIt\Auditing\Contracts\Auditable;


class User extends Authenticatable implements Auditable
{
  use HasApiTokens, HasFactory, Notifiable;
  use HasRoles;
  use SoftDeletes;
  use \OwenIt\Auditing\Auditable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'first_name',
    'last_name',
    'id_number',
    'email',
    'phone_number',
    'address',
    'photo_url',
    'password',
    'role',
    'course_id',
    'created_by',
    'updated_by',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'password' => 'hashed',
  ];

  public function books()
  {
    return $this->belongsToMany('App\Models\Book', 'cart', 'user_id', 'book_id');
  }
}
