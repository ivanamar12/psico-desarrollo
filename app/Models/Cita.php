<?php

namespace App\Models;

use App\Traits\FormatsDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cita extends Model
{
  use HasFactory, FormatsDates;

  protected $fillable = [
    'paciente_id',
    'especialista_id',
    'fecha_consulta',
    'hora',
    'status'
  ];

  public function paciente(): BelongsTo
  {
    return $this->belongsTo(Paciente::class);
  }

  public function especialista(): BelongsTo
  {
    return $this->belongsTo(Especialista::class);
  }

  /**
   * Accessors
   */
  public function getFechaConsultaShortAttribute()
  {
    return $this->getFormattedShortDateAttribute('fecha_consulta');
  }

  public function getFechaConsultaLongAttribute()
  {
    return $this->getFormattedLongDateAttribute('fecha_consulta');
  }
}
