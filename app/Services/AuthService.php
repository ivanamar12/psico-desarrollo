<?php

namespace App\Services;

use App\Models\User;

class AuthService
{
  public static function getUser($email)
  {
    $user = User::where('email', $email)
      ->first();

    return $user;
  }
}
