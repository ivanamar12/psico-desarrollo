<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AplicacionPrueba extends Model
{
  use HasFactory;

  protected $fillable = [
    'resultados',
    'resultados_finales',
    'prueba_id',
    'especialista_id',
    'paciente_id'
  ];

  protected $casts = [
    'resultados' => 'array',
    'resultados_finales' => 'array',
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
   * Define la relación BelongsTo con el modelo Prueba.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function prueba(): BelongsTo
  {
    return $this->belongsTo(Prueba::class);
  }
}
