<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubEscala;
 
class SubEsacalaTableSeeder extends Seeder
{
    public function run()
    {
        SubEscala::create(['prueba' => 'CUMANIN', 'escala' => 'Desarrollo Verbal']);
        SubEscala::create(['prueba' => 'CUMANIN', 'escala' => 'Desarrollo no Verbal']);
        SubEscala::create(['prueba' => 'CUMANIN', 'escala' => 'Psicomotricidad']);
        SubEscala::create(['prueba' => 'CUMANIN', 'escala' => 'Lenguaje Articulatorio']);
        SubEscala::create(['prueba' => 'CUMANIN', 'escala' => 'Lenguaje Expresivo']);
        SubEscala::create(['prueba' => 'CUMANIN', 'escala' => 'Lenguaje Comprensivo']);
        SubEscala::create(['prueba' => 'CUMANIN', 'escala' => 'Estructuracion Espacial']);
        SubEscala::create(['prueba' => 'CUMANIN', 'escala' => 'Visopercepcion']);
        SubEscala::create(['prueba' => 'CUMANIN', 'escala' => 'Memoria Iconica']);
        SubEscala::create(['prueba' => 'CUMANIN', 'escala' => 'Ritmo']);
        SubEscala::create(['prueba' => 'CUMANIN', 'escala' => 'Fluidez Verbal']);
        SubEscala::create(['prueba' => 'CUMANIN', 'escala' => 'Atencion']);
        SubEscala::create(['prueba' => 'CUMANIN', 'escala' => 'Lectura']);
        SubEscala::create(['prueba' => 'CUMANIN', 'escala' => 'Escritura']);
        SubEscala::create(['prueba' => 'KOPPITZ', 'escala' => 'Dibujo Figura Humana']);
    }
}
