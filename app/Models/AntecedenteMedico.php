<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AntecedenteMedico extends Model
{
  use HasFactory;

  protected $fillable = [
    'enfermedad_infecciosa',
    'tipo_enfermedad_infecciosa',
    'enfermedad_no_infecciosa',
    'tipo_enfermedad_no_infecciosa',
    'enfermedad_cronica',
    'tipo_enfermedad_cronica',
    'discapacidad',
    'tipo_discapacidad',
    'otros',
    'observacion'
  ];

  public function historiaclinicas(): HasMany
  {
    return $this->hasMany(HistoriaClinica::class);
  }
}
