<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosEconomico extends Model
{
    use HasFactory;

    protected $fillable = ['tipo_vivienda', 'cantidad_habitaciones', 'cantidad_personas', 'servecio_agua_potable','servecio_gas', 'servecio_electricidad', 'servecio_drenaje', 'disponibilidad_internet', 'tipo_conexion_internet', 'acceso_servcios_publicos', 'fuente_ingreso_familiar'];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id', 'datoseconomico_id');
    }
    

}
