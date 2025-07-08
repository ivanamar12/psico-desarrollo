<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
  use HasFactory;

  protected $fillable = [
    'fecha_emision',
    'fecha_vencimiento',
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
}
