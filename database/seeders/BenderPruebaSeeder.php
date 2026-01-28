<?php
	namespace Database\Seeders;

	use Illuminate\Database\Seeder;
	use App\Models\Prueba;

	class BenderPruebaSeeder extends Seeder
	{
	    public function run()
	    {
	        Prueba::updateOrInsert(
	            ['nombre' => 'Bender'], 
	            [
	                'descripcion' => 'Es una prueba neuropsicológica que evalúa la integración visuomotriz, habilidades motoras y perceptuales a través de la reproducción de figuras geométricas, utilizada principalmente en la evaluación del desarrollo infantil.',
	                'rango_edad' => '49-72 meses',
	                'area_desarrollo' => 'Motora',
	                'tipo' => 'Estandarizada'
	            ]
	        );
	    }
	}

