<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultadosPruebas extends Model
{
    use HasFactory;

    protected $fillable = ['aplicacion_pruebas_id', 'resultados_finales'];

    protected $casts = [
        'resultados' => 'array', 
    ];

    public function aplicacionPrueba()
    {
        return $this->belongsTo(AplicacionPrueba::class)->withDefault();
    }
}
