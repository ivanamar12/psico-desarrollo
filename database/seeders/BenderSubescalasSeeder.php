<?php

namespace Database\Seeders;

use App\Models\Prueba;
use App\Models\SubEscala;
use Illuminate\Database\Seeder;

class BenderSubescalasSeeder extends Seeder
{
  public function run()
  {
    $bender = Prueba::where('nombre', 'Bender')->first();

    // Figura A
    SubEscala::create([
      'prueba_id' => $bender->id,
      'sub_escala' => 'Figura A',
      'descripcion' => 'Tarjeta de evaluación'
    ]);

    // Figura 1
    SubEscala::create([
      'prueba_id' => $bender->id,
      'sub_escala' => 'Figura 1',
      'descripcion' => 'Tarjeta de evaluación'
    ]);

    // Figura 2
    SubEscala::create([
      'prueba_id' => $bender->id,
      'sub_escala' => 'Figura 2',
      'descripcion' => 'Tarjeta de evaluación'
    ]);

    // Figura 3
    SubEscala::create([
      'prueba_id' => $bender->id,
      'sub_escala' => 'Figura 3',
      'descripcion' => 'Tarjeta de evaluación'
    ]);

    // Figura 4
    SubEscala::create([
      'prueba_id' => $bender->id,
      'sub_escala' => 'Figura 4',
      'descripcion' => 'Tarjeta de evaluación'
    ]);

    // Figura 5
    SubEscala::create([
      'prueba_id' => $bender->id,
      'sub_escala' => 'Figura 5',
      'descripcion' => 'Tarjeta de evaluación'
    ]);

    // Figura 6
    SubEscala::create([
      'prueba_id' => $bender->id,
      'sub_escala' => 'Figura 6',
      'descripcion' => 'Tarjeta de evaluación'
    ]);

    // Figura 7
    SubEscala::create([
      'prueba_id' => $bender->id,
      'sub_escala' => 'Figura 7',
      'descripcion' => 'Tarjeta de evaluación'
    ]);

    // Figura 8
    SubEscala::create([
      'prueba_id' => $bender->id,
      'sub_escala' => 'Figura 8',
      'descripcion' => 'Tarjeta de evaluación'
    ]);
  }
}

