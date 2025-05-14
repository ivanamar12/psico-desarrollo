<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class LoginService
{
  public static function getUser($credentials)
  {
    $user = null;

    if (isset($credentials['email'])) {
      $user = User::where('email', $credentials['email'])->first();
    }

    return $user;
  }

  public static function createKey($userId)
  {
    return "login_attempts:" . $userId;
  }

  public static function clearLoginAttempts($userId)
  {
    Cache::forget(self::createKey($userId));
  }
}
