<?php

namespace App\Enums;

enum UserRoles: string
{
  case Borrower = 'borrower';
  case Staff = 'staff';
}
