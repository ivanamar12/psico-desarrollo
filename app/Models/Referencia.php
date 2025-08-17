<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Referencia extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'fecha_emision',
    'fecha_vencimiento',
    'titulo',
    'motivo',
    'presentacion_caso',
    'antecedentes',
    'indicadores_psicologicos',
    'sugerencias',
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
}
