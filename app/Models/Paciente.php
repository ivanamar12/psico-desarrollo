<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'apellido', 'fecha_nac', 'lugar_id', 'representante_id', 'datoseconomico_id', 'genero_id'];

    public function datosEconomico(){

        return $this->belongsTo(DatosEconomico::class);
        
    }
    public function representante(){

        return $this->belongsTo(Representante::class);
        
    }
    public function parentescos(){

        return $this->hasMany(Parentesco::class);
        
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

    public function aplicacionPruebas()
    {
    	return $this->hasMany(AplicacionPrueba::class);
    }
}