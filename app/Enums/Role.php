<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum Role: string
{
  use BaseEnum;

  case ADMIN = 'ADMIN';
  case DELIVERY_MAN = 'DELIVERY_MAN';
  case CUSTOMER = 'CUSTOMER';

  public static function translation()
  {
    return [
      'ADMIN' => 'ADMIN',
      'DELIVERY_MAN' => 'REPARTIDOR',
      'CUSTOMER' => 'CLIENTE',
    ];
  }

  public function label(): string
  {
    return match ($this) {
      static::ADMIN => 'Writers',
      static::DELIVERY_MAN => 'Editors',
      static::CUSTOMER => 'User Managers',
    };
  }
}
