<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RangoPrueba extends Model
{
    use HasFactory;

    protected $fillable = ['rango_edad'];

    public function pruebas(){

    	return $this->hasMany(Prueba::class);
    	 
    }
}
