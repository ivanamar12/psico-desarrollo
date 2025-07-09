<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubEscala extends Model
{
  use HasFactory;

  protected $fillable = [
    'prueba_id',
    'sub_escala',
    'descripcion'
  ];

  public function prueba(): BelongsTo
  {
    return $this->belongsTo(Prueba::class);
  }

  public function Items(): HasMany
  {
    return $this->hasMany(Item::class);
  }

  public function Baremos(): HasMany
  {
    return $this->hasMany(Baremos::class);
  }
}
