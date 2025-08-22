<?php

use Carbon\Carbon;

if (!function_exists('current_user')) {
  function current_user()
  {
    return auth()->user();
  }
}

if (! function_exists('format_long_date')) {
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

if (! function_exists('format_day_month')) {
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
