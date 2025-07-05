<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Especialista extends Model
{
  use HasFactory;

  protected $fillable = [
    'nombre',
    'apellido',
    'ci',
    'fecha_nac',
    'especialidad',
    'telefono',
    'email',
    'fvp',
    'user_id',
    'especialidad_id',
    'genero_id',
    'direccion_id'
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function direccion(): BelongsTo
  {
    return $this->belongsTo(Direccion::class);
  }

  public function genero(): BelongsTo
  {
    return $this->belongsTo(Genero::class);
  }

  public function especialidad(): BelongsTo
  {
    return $this->belongsTo(Especialidad::class);
  }

  public function citas(): HasMany
  {
    return $this->hasMany(Cita::class);
  }

  public static function obtenerEspecialista($id)
  {
    return self::with([
      'genero',
      'especialidad',
      'direccion.estado',
      'direccion.municipio',
      'direccion.parroquia'
    ])
      ->where('id', $id)
      ->first();
  }
}
