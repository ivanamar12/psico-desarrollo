<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntecedenteMedico extends Model
{
    use HasFactory;

    protected $fillable = ['enfermedad_infecciosa', 'tipo_enfermedad_infecciosa', 'enfermedad_no_infecciosa', 'tipo_enfermedad_no_infecciosa','enfermedad_cronica', 'tipo_enfermedad_cronica', 'discapacidad', 'tipo_discapacidad', 'otros'];


    public function historiaclinicas(){

    	return $this->hasMany(HistoriaClinica::class);
    	 
    }
}
