<?php

namespace App\Models;

use Carbon\Carbon;
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

  public function informes(): HasMany
  {
    return $this->hasMany(Informe::class);
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

  /**
   * Get the formatted release date as DD/MM/YYYY.
   *
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function getFechaFormateadaDDMMYYYYAttribute(): string
  {
    if (empty($this->fecha_nac)) return 'N/A';

    try {
      return Carbon::parse($this->fecha_nac)->format('d/m/Y');
    } catch (\Exception $e) {
      return 'Fecha inválida';
    }
  }

  public function getTiempoTranscurridoAttribute()
  {
    if (empty($this->fecha_nac)) {
      return 'Fecha no disponible';
    }

    $carbonFecha = Carbon::parse($this->fecha_nac);
    $ahora = Carbon::now();
    $diff = $carbonFecha->diff($ahora);

    $years = $diff->y;
    $months = $diff->m;

    $output = '';

    if ($years > 0) {
      $output .= $years . ' año' . ($years > 1 ? 's' : '');
    }

    if ($months > 0) {
      if ($years > 0) {
        $output .= ' y ';
      }
      $output .= $months . ' mes' . ($months > 1 ? 'es' : '');
    }

    if (empty($output)) {
      $output = 'menos de un mes';
    }

    return $output;
  }
}
