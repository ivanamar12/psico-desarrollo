<?php

use Carbon\Carbon;

if (!function_exists('current_user')) {
  function current_user()
  {
    return auth()->user();
  }
}

if (!function_exists('format_long_date')) {
  /**
   * Convierte una fecha a un formato largo y legible en español.
   * Ejemplo: "15 de noviembre de 2025"
   *
   * @param string|Carbon $date La fecha a formatear.
   * @return string
   */
  function format_long_date(string|Carbon $date): string
  {
    if (empty($date)) return '';

    try {
      $carbonInstance = Carbon::parse($date);
      return $carbonInstance->isoFormat('DD \d\e MMMM \d\e YYYY');
    } catch (\Exception $e) {
      return 'Fecha no valida';
    }
  }
}

if (!function_exists('format_day_month')) {
  /**
   * Convierte una fecha a un formato simple y legible en español.
   * Ejemplo: "15 de noviembre"
   *
   * @param string|Carbon $date La fecha a formatear.
   * @return string
   */
  function format_day_month(string|Carbon $date): string
  {
    if (empty($date)) return '';

    try {
      $carbonInstance = Carbon::parse($date);
      return $carbonInstance->isoFormat('DD \d\e MMMM');
    } catch (\Exception $e) {
      return 'Fecha no valida';
    }
  }
}

if (!function_exists('get_formal_date')) {
  /**
   * Convierte una fecha a un formato formal y legible en español.
   * Ejemplo: "a los 22 días del mes de agosto del año 2025"
   *
   * @param Carbon $date La fecha a formatear.
   * @return string
   */
  function get_formal_date(Carbon $date): string
  {
    return $date->day === 1
      ? "al primer día"
      : "a los {$date->day} días" . " del mes de {$date->monthName} del año {$date->year}";
  }
}
