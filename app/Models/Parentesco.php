<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Parentesco extends Model
{
  use HasFactory;

  protected $fillable = [
    'paciente_id',
    'nombre',
    'apellido',
    'fecha_nac',
    'parentesco',
    'discapacidad',
    'tipo_discapacidad',
    'enfermedad_cronica',
    'tipo_enfermedad',
    'genero_id'
  ];

  protected $appends = ['fecha_nac_formatted'];

  public function paciente(): BelongsTo
  {
    return $this->belongsTo(Paciente::class);
  }

  public function genero(): BelongsTo
  {
    return $this->belongsTo(Genero::class);
  }

  public function getFechaNacFormattedAttribute()
  {
    return format_date_with_age($this->fecha_nac);
  }
}
