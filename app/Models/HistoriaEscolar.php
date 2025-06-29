<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HistoriaEscolar extends Model
{
  use HasFactory;

  protected $fillable = [
    'escolarizado',
    'tipo_educaion',
    'tutoria_terapias',
    'tutoria_terapias_cuales',
    'dificultad_lectura',
    'dificultad_aritmetica',
    'dificultad_escribir',
    'agrada_escuela',
    'observacion'
  ];

  public function historiaclinicas(): HasMany
  {
    return $this->hasMany(HistoriaClinica::class);
  }
}
