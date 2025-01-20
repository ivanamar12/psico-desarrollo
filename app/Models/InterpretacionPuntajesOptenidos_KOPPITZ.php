<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterpretacionPuntajesOptenidos_KOPPITZ extends Model
{
    use HasFactory;

    protected $fillable = ['puntaje_dfh','nivel_capacidad_mental', 'CI'];
}
