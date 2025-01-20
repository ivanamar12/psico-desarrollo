<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InterpretacionPuntajesOptenidos_KOPPITZ;

class a  extends Seeder
{
    public function run()
    {
        InterpretacionPuntajesOptenidos_KOPPITZ::create(['puntaje_dfh' => '8-7', 'nivel_capacidad_mental' => 'Normal alto a superior', 'CI' => '110 o mas']);
        InterpretacionPuntajesOptenidos_KOPPITZ::create(['puntaje_dfh' => '6', 'nivel_capacidad_mental' => 'Normal a superior', 'CI' => '90-135']);
        InterpretacionPuntajesOptenidos_KOPPITZ::create(['puntaje_dfh' => '5', 'nivel_capacidad_mental' => 'Normal  alto', 'CI' => '85-120']);
        InterpretacionPuntajesOptenidos_KOPPITZ::create(['puntaje_dfh' => '4', 'nivel_capacidad_mental' => 'Normal bajo a normal', 'CI' => '80-110']);
        InterpretacionPuntajesOptenidos_KOPPITZ::create(['puntaje_dfh' => '3', 'nivel_capacidad_mental' => 'Normal bajo', 'CI' => '70-90']);
        InterpretacionPuntajesOptenidos_KOPPITZ::create(['puntaje_dfh' => '2', 'nivel_capacidad_mental' => 'Bordeline', 'CI' => '60-80']);
        InterpretacionPuntajesOptenidos_KOPPITZ::create(['puntaje_dfh' => '1-0', 'nivel_capacidad_mental' => 'Deficiente o Funcionando en un nivel deficiente debido a problemas emocionales', 'CI' => '-']);
    }
}
