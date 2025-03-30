<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialista extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellido', 'ci', 'fecha_nac', 'especialidad', 'telefono', 'email','especialidad_id','genero_id', 'direccion_id'];

    public function direccion(){

    	return $this->belongsTo(Direccion::class);
    	
    }

    public function genero(){

    	return $this->belongsTo(Genero::class);
    	
    }

    public function especialidad(){

    	return $this->belongsTo(Especialidad::class);
    	
    }

    public function citas(){

    	return $this->hasMany(Cita::class);
    	 
    }

    public static function obtenerEspecialista($id)
    {
        return self::with([
            'genero',
            'especialidad',
            'direccion.estado',
            'direccion.municipio',
            'direccion.parroquia'
        ])
        ->where('id', $id)
        ->first();
    }
}
