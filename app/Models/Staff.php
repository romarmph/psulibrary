<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Staff extends Model implements Auditable
{
  use HasFactory;
  use SoftDeletes;
  use \OwenIt\Auditing\Auditable;

  protected $fillable = [
    'first_name',
    'last_name',
    'employee_number',
    'photoUrl',
    'password',
    'created_by',
    'updated_by',
    'deleted_by',
  ];
}
