<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LugarNacimiento extends Model
{
    use HasFactory;
    protected $fillable = ['estado_id', 'municipio_id', 'parroquia_id', 'lugar'];

    public function estado(){

      return $this->belongsTo(Estado::class);
      
  }

     public function municipio(){

      return $this->belongsTo(Municipio::class);
      
  }

     public function parroquia(){

      return $this->belongsTo(Parroquia::class);
      
  }

   public function pacientes(){

      return $this->hasMany(Paciente::class);
       
  }
}
