<?php
namespace App\Observers;

use App\Models\AplicacionPrueba;
use Illuminate\Support\Facades\Http;

class AplicacionPruebaObserver
{
    public function created(AplicacionPrueba $prueba)
    {
        $tipoPrueba = $prueba->prueba->tipo;
        $nombrePrueba = $prueba->prueba->nombre; 

        Http::post(env('APP_URL') . '/api/analizar-prueba', [
            'prueba_id' => $prueba->id,
            'tipo_prueba' => $tipoPrueba,
            'nombre' => $nombrePrueba 
        ]);
    }
}
