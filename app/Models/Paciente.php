<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'apellido', 'fecha_nac', 'lugar_id', 'representante_id', 'padre_id', 'genero_id'];

    public function lugarNacimientos(){

        return $this->belongsTo(LugarNacimiento::class);
        
    }

    public function representante(){

        return $this->belongsTo(Representante::class);
        
    }

    public function padre(){

        return $this->belongsTo(Padres::class);
        
    }

    public function genero(){

        return $this->belongsTo(Genero::class);
        
    }

    public function citas(){

    	return $this->hasMany(Cita::class);
    	 
    }

    public function historiaclinicas(){

    	return $this->hasMany(HistoriaClinica::class);
    	 
    }
}
