<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $fillable = ['estado'];

    public function municipios(){

    	return $this->hasMany(Municipio::class);
    	 
    }

    public function direccions(){

    	return $this->hasMany(Direccion::class);
    	 
    }

    public function lugarNacimientos(){

    	return $this->hasMany(LugarNacimiento::class);
    	 
    }
}
