<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prueba;

class PruebaSeeder extends Seeder
{
  public function run()
  {
    Prueba::create(['nombre' => 'CUMANIN', 'descripcion' => 'Es una evaluación neuropsicológica diseñada para medir el desarrollo cognitivo y neuropsicológico en niños de 3 a 6 años. Evalúa habilidades como el lenguaje, la percepción, la memoria, la motricidad y la atención, proporcionando información clave para detectar posibles dificultades en el desarrollo infantil', 'rango_edad' => '36-78 meses', 'area_desarrollo' => 'Cognitiva', 'tipo' => 'Estandarizada']);
    Prueba::create(['nombre' => 'Koppitz', 'descripcion' => 'Es una evaluación basada en el Test de Dibujo de la Figura Humana, utilizada para medir el desarrollo cognitivo, emocional y perceptomotor en niños. Permite identificar posibles dificultades en el aprendizaje, la maduración neurológica y aspectos emocionales a través del análisis de los detalles en el dibujo realizado por el niño', 'rango_edad' => '60-78 meses', 'area_desarrollo' => 'Socio-Afectiva', 'tipo' => 'Estandarizada']);
  }
}
