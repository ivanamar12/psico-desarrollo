<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoriaClinica extends Model
{
  use HasFactory;

  protected $fillable = [
    'paciente_id',
    'historia_desarrollo_id',
    'antecedente_medico_id',
    'historia_escolar_id',
    'codigo',
    'referencia',
    'especialista_refirio',
    'motivo',
    'observacion'
  ];

  // Relación con el modelo Paciente
  public function paciente(): BelongsTo
  {
    return $this->belongsTo(Paciente::class);
  }

  // Relación con el modelo HistoriaDesarrollo
  public function historiaDesarrollo(): BelongsTo
  {
    return $this->belongsTo(HistoriaDesarrollo::class);
  }

  // Relación con el modelo AntecedenteMedico
  public function antecedenteMedico(): BelongsTo
  {
    return $this->belongsTo(AntecedenteMedico::class);
  }

  // Relación con el modelo HistoriaEscolar
  public function historiaEscolar(): BelongsTo
  {
    return $this->belongsTo(HistoriaEscolar::class);
  }
}
