<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AplicacionPrueba extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'paciente_id', 'prueba_id', 'resultados'];

    protected $casts = [
        'resultados' => 'array', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(); 
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class)->withDefault();
    }

    public function prueba()
    {
        return $this->belongsTo(Prueba::class)->withDefault();
    }

    // Definir la relación con ResultadosPruebas
    public function resultadosPruebas()
    {
        return $this->hasMany(ResultadosPruebas::class, 'aplicacion_pruebas_id');
    }
}
