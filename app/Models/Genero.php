<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genero extends Model
{
  use HasFactory;

  protected $fillable = ['genero'];

  public function especialistas(): HasMany
  {
    return $this->hasMany(Especialista::class);
  }

  public function secretarias(): HasMany
  {
    return $this->hasMany(Secretaria::class);
  }

  public function representantes(): HasMany
  {
    return $this->hasMany(Representante::class);
  }

  public function pacientes(): HasMany
  {
    return $this->hasMany(Paciente::class);
  }
}
