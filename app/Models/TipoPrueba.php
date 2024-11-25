<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPrueba extends Model
{
    use HasFactory;

    protected $fillable = ['tipo'];

    public function pruebas(){

    	return $this->hasMany(Prueba::class);
    	 
    }
}
