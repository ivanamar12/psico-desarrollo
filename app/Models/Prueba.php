<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'rango_edad', 'area_desarrollo', 'tipo'];

    public function subEscalas(){

    	return $this->hasMany(SubEscala::class);
    	
    }
}
