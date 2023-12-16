<?php

namespace App\Enums;

enum UserRoles: string
{
  case Faculty = 'faculty';
  case Student = 'student';
  case Admin = 'admin';
}
