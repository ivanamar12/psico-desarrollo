<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaDesarrollo extends Model
{
    use HasFactory;

    protected $fillable = ['area_desarrollo'];

    public function pruebas(){

    	return $this->hasMany(Prueba::class);
    	 
    }
}
