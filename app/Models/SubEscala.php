<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubEscala extends Model
{
    use HasFactory;

    protected $fillable = ['prueba','escala'];


    public function desarrolloVerbals(){

    	return $this->hasMany(DesarrolloVerbal::class);
    	 
    }

    public function desarrolloNoVerbals(){

    	return $this->hasMany(DesarrolloNoVerbal::class);
    	 
    }

    public function psicomotricidadCumanins(){

    	return $this->hasMany(PsicomotricidadCumanin::class);
    	 
    }

    public function lenguajeArticulatorios(){

    	return $this->hasMany(LenguajeArticulatorio::class);
    	 
    }

    public function lenguajeExpresivos(){

    	return $this->hasMany(LenguajeExpresivo::class);
    	 
    }

    public function lenguajeComprensivos(){

    	return $this->hasMany(LenguajeComprensivo::class);
    	 
    }

    public function estructuracionEsapacials(){

    	return $this->hasMany(EstructuracionEsapacial::class);
    	 
    }

    public function Visopercepcions(){

    	return $this->hasMany(Visopercepcion::class);
    	 
    }

    public function memoriaIconicas(){

    	return $this->hasMany(MemoriaIconica::class);
    	 
    }

    public function ritmos(){

    	return $this->hasMany(Ritmo::class);
    	 
    }

    public function fluidezVerbals(){

    	return $this->hasMany(FluidezVerbal::class);
    	 
    }

    public function atencions(){

    	return $this->hasMany(Atencion::class);
    	 
    }

    public function lecturas(){

    	return $this->hasMany(Lectura::class);
    	 
    }

    public function dibujoFiguraHumanas(){

    	return $this->hasMany(DibujoFiguraHumana::class);
    	 
    }
}
