<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Informe extends Model
{
  use HasFactory;

  protected $fillable = [
    'fecha_emision',
    'fecha_vencimiento',
    'motivo',
    'recursos',
    'instrumentos',
    'condiciones_generales',
    'fisica_salud',
    'perceptivo_motriz',
    'coeficiente_intelectual',
    'afectiva_social',
    'conclusion',
    'recomendaciones',
    'especialista_id',
    'paciente_id'
  ];

  /**
   * Define la relación BelongsTo con el modelo Especialista.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function especialista(): BelongsTo
  {
    return $this->belongsTo(Especialista::class);
  }

  /**
   * Define la relación BelongsTo con el modelo Paciente.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function paciente(): BelongsTo
  {
    return $this->belongsTo(Paciente::class);
  }

  /**
   * Obtiene la fecha de emisión formateada como "DD de Mes de YYYY".
   *
   * @return string
   */
  protected function getFechaEmisionLargaAttribute(): string
  {
    if (empty($this->fecha_emision)) return 'Fecha no especificada';

    try {
      Carbon::setLocale('es');

      return Carbon::parse($this->fecha_emision)->isoFormat('DD \d\e MMMM \d\e YYYY');
    } catch (\Exception $e) {
      return 'Fecha inválida';
    }
  }
}
