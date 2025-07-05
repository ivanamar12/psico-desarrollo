<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prueba extends Model
{
  use HasFactory;

  protected $fillable = [
    'nombre',
    'descripcion',
    'rango_edad',
    'area_desarrollo',
    'tipo'
  ];

  public function subEscalas(): HasMany
  {
    return $this->hasMany(SubEscala::class);
  }

  public function aplicacionPruebas(): HasMany
  {
    return $this->hasMany(AplicacionPrueba::class);
  }
}
