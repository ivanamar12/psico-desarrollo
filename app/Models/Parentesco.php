<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parentesco extends Model
{
    use HasFactory;

    protected $fillable = ['paciente_id', 'nombre', 'apellido', 'fecha_nac','parentesco', 'discapacidad', 'tipo_discapacidad', 'enfermedad_cronica', 'tipo_enfermedad'];

    public function paciente(){

        return $this->belongsTo(Paciente::class);
        
    }

}
