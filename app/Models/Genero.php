<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;

    protected $fillable = ['genero'];

    public function especialistas(){

        return $this->hasMany(Especialista::class);
         
    }

    public function secretarias(){

        return $this->hasMany(Secretaria::class);
         
    }

    public function representantes(){

        return $this->hasMany(Representante::class);
         
    }

    public function pacientes(){

        return $this->hasMany(Paciente::class);
         
    }
}
