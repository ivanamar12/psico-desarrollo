<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Padres extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_mama','apellido_mama','ci_mama','fecha_nac_mama','grado_mama','telefono_mama','email_mama','nombre_papa','apellido_papa','ci_papa','fecha_nac_papa','grado_papa','telefono_papa','email_papa','estado_civil','custodia_niño','direccion_id'];
    
    public function pacientes(){

        return $this->hasMany(Paciente::class);
         
    }

    public function direccion(){

    	return $this->belongsTo(Direccion::class);
    	
    }
}
