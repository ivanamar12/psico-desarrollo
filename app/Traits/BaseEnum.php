<?php

namespace App\Traits;

trait BaseEnum
{
  /**
   * Return array with cases of Enum
   */
  public static function options(): array
  {
    return collect(self::cases())
      ->map(function ($enum) {
        if (property_exists($enum, "value")) return $enum->value;
        return $enum->name;
      })
      ->values()
      ->toArray();
  }

  /**
   * Return array with keys and values equal
   */
  public static function swap(): array
  {
    $values = [];
    foreach (self::options() as $value) {
      $values[$value] = $value;
    }
    return $values;
  }

  /**
   * Return translation of Enum
   */
  public static function translate()
  {
    return collect(self::values())
      ->map(fn($value) => [
        'value' => $value,
        'label' => static::translation()[$value],
      ]);
  }
}
