<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum Role: string
{
  use BaseEnum;

  case ADMIN = 'ADMIN';
  case SPECIALIST = 'SPECIALIST';
  case SECRETARY = 'SECRETARY';

  public static function translation()
  {
    return [
      'ADMIN' => 'ADMIN',
      'SPECIALIST' => 'ESPECIALISTA',
      'SECRETARY' => 'SECRETARIA',
    ];
  }

  public function label(): string
  {
    return match ($this) {
      static::ADMIN => 'ADMIN',
      static::SPECIALIST => 'SPECIALIST',
      static::SECRETARY => 'SECRETARY',
    };
  }
}
