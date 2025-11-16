<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Secretaria extends Model
{
  use HasFactory;

  protected $fillable = [
    'nombre',
    'apellido',
    'ci',
    'fecha_nac',
    'grado',
    'telefono',
    'email',
    'user_id',
    'genero_id',
    'direccion_id'
  ];

  protected $appends = ['fecha_nac_formatted'];

  public function direccion(): BelongsTo
  {
    return $this->belongsTo(Direccion::class);
  }

  public function genero(): BelongsTo
  {
    return $this->belongsTo(Genero::class);
  }

  public static function obtenerSecretaria($id)
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

  public function getFechaNacFormattedAttribute()
  {
    return format_date_with_age($this->fecha_nac);
  }
}
