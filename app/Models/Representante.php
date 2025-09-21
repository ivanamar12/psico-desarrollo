<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Representante extends Model
{
  use HasFactory;
  protected $fillable = [
    'nombre',
    'apellido',
    'ci',
    'telefono',
    'email',
    'genero_id',
    'direccion_id'
  ];

  public function direccion(): BelongsTo
  {
    return $this->belongsTo(Direccion::class);
  }

  public function genero(): BelongsTo
  {
    return $this->belongsTo(Genero::class);
  }

  public static function obtenerRepresentante($id)
  {
    return self::with([
      'genero',
      'direccion.estado',
      'direccion.municipio',
      'direccion.parroquia'
    ])
      ->where('id', $id)
      ->first();
  }
}
