<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Paciente extends Model
{
  use HasFactory;

  protected $fillable = [
    'nombre',
    'apellido',
    'fecha_nac',
    'lugar_id',
    'representante_id',
    'datoseconomico_id',
    'genero_id'
  ];

  public function datosEconomico(): HasOne
  {
    return $this->hasOne(DatosEconomico::class, 'id', 'datoseconomico_id');
  }

  public function representante(): BelongsTo
  {
    return $this->belongsTo(Representante::class);
  }

  public function parentescos(): HasMany
  {
    return $this->hasMany(Parentesco::class);
  }

  public function genero(): BelongsTo
  {
    return $this->belongsTo(Genero::class);
  }

  public function citas(): HasMany
  {
    return $this->hasMany(Cita::class);
  }

  public function historiaclinicas(): HasMany
  {
    return $this->hasMany(HistoriaClinica::class);
  }

  public function aplicacionPruebas(): HasMany
  {
    return $this->hasMany(AplicacionPrueba::class);
  }

  public static function obtenerPaciente($id)
  {
    return self::with([
      'genero',
      'representante',
      'datosEconomico',
      'parentescos'
    ])
      ->where('id', $id)
      ->first();
  }
}
