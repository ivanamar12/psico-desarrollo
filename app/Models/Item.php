<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
  use HasFactory;

  protected $fillable = [
    'sub_escala_id',
    'item'
  ];

  public function SubEscala(): BelongsTo
  {
    return $this->belongsTo(SubEscala::class);
  }
}
