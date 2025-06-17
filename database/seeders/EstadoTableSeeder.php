<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoTableSeeder extends Seeder
{
	public function run()
	{
		/* ESTADOS */
		Estado::create(array('id' => 1, 'estado' => 'Amazonas', 'iso_3166-2' => 'VE-X'));
		Estado::create(array('id' => 2, 'estado' => 'Anzoátegui', 'iso_3166-2' => 'VE-B'));
		Estado::create(array('id' => 3, 'estado' => 'Apure', 'iso_3166-2' => 'VE-C'));
		Estado::create(array('id' => 4, 'estado' => 'Aragua', 'iso_3166-2' => 'VE-D'));
		Estado::create(array('id' => 5, 'estado' => 'Barinas', 'iso_3166-2' => 'VE-E'));
		Estado::create(array('id' => 6, 'estado' => 'Bolívar', 'iso_3166-2' => 'VE-F'));
		Estado::create(array('id' => 7, 'estado' => 'Carabobo', 'iso_3166-2' => 'VE-G'));
		Estado::create(array('id' => 8, 'estado' => 'Cojedes', 'iso_3166-2' => 'VE-H'));
		Estado::create(array('id' => 9, 'estado' => 'Delta Amacuro', 'iso_3166-2' => 'VE-Y'));
		Estado::create(array('id' => 10, 'estado' => 'Falcón', 'iso_3166-2' => 'VE-I'));
		Estado::create(array('id' => 11, 'estado' => 'Guárico', 'iso_3166-2' => 'VE-J'));
		Estado::create(array('id' => 12, 'estado' => 'Lara', 'iso_3166-2' => 'VE-K'));
		Estado::create(array('id' => 13, 'estado' => 'Mérida', 'iso_3166-2' => 'VE-L'));
		Estado::create(array('id' => 14, 'estado' => 'Miranda', 'iso_3166-2' => 'VE-M'));
		Estado::create(array('id' => 15, 'estado' => 'Monagas', 'iso_3166-2' => 'VE-N'));
		Estado::create(array('id' => 16, 'estado' => 'Nueva Esparta', 'iso_3166-2' => 'VE-O'));
		Estado::create(array('id' => 17, 'estado' => 'Portuguesa', 'iso_3166-2' => 'VE-P'));
		Estado::create(array('id' => 18, 'estado' => 'Sucre', 'iso_3166-2' => 'VE-R'));
		Estado::create(array('id' => 19, 'estado' => 'Táchira', 'iso_3166-2' => 'VE-S'));
		Estado::create(array('id' => 20, 'estado' => 'Trujillo', 'iso_3166-2' => 'VE-T'));
		Estado::create(array('id' => 21, 'estado' => 'Vargas', 'iso_3166-2' => 'VE-W'));
		Estado::create(array('id' => 22, 'estado' => 'Yaracuy', 'iso_3166-2' => 'VE-U'));
		Estado::create(array('id' => 23, 'estado' => 'Zulia', 'iso_3166-2' => 'VE-V'));
		Estado::create(array('id' => 24, 'estado' => 'Distrito Capital', 'iso_3166-2' => 'VE-A'));
		Estado::create(array('id' => 25, 'estado' => 'Dependencias Federales', 'iso_3166-2' => 'VE-Z'));
	}
}
