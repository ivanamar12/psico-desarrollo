<?php

namespace App\Traits;

use Carbon\Carbon;
use Exception;

trait FormatsDates
{
  /**
   * Gets the date formatted as "Month DD, YYYY".
   *
   * @param string $dateAttribute Name of the date attribute
   * @return string
   */
  public function getFormattedLongDateAttribute(string $dateAttribute): string
  {
    if (empty($this->$dateAttribute)) return 'Fecha no especificada';

    try {
      Carbon::setLocale('es');
      return Carbon::parse($this->fecha_emision)->isoFormat('DD \d\e MMMM \d\e YYYY');
    } catch (Exception $e) {
      return 'Fecha invalida';
    }
  }

  /**
   * Gets the date formatted as "DD/MM/YYYY".
   *
   * @param string $dateAttribute Name of the date attribute
   * @return string
   */
  public function getFormattedShortDateAttribute(string $dateAttribute): string
  {
    if (empty($this->$dateAttribute)) {
      return 'N/A';
    }

    try {
      return Carbon::parse($this->$dateAttribute)->format('d/m/Y');
    } catch (Exception $e) {
      return 'Invalid date';
    }
  }

  /**
   * Gets the date with time formatted as "MMMM DD, YYYY hh:mm A".
   *
   * @param string $dateAttribute Name of the date attribute
   * @return string
   */
  public function getFormattedDateTimeAttribute(string $dateAttribute): string
  {
    if (empty($this->$dateAttribute)) return 'Fecha no especificada';

    try {
      Carbon::setLocale('es');
      return Carbon::parse($this->$dateAttribute)->isoFormat('MMMM DD, YYYY hh:mm A');
    } catch (Exception $e) {
      return 'Invalid date/time';
    }
  }
}
