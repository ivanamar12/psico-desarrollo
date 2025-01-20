<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lectura;

class LecturaTableSeeder extends Seeder
{
    public function run()
    {
        Lectura::create(['sub_escala_id' => '13', 'percentil' => '98', '61-66 meses' => '12', '67-72 meses' => 'NULL', '73-78 meses' => 'NULL']);
        Lectura::create(['sub_escala_id' => '13', 'percentil' => '97', '61-66 meses' => '-', '67-72 meses' => '20', '73-78 meses' => 'NULL']);
        Lectura::create(['sub_escala_id' => '13', 'percentil' => '96', '61-66 meses' => '11', '67-72 meses' => '-', '73-78 meses' => 'NULL']);
        Lectura::create(['sub_escala_id' => '13', 'percentil' => '95', '61-66 meses' => '9-10', '67-72 meses' => '12', '73-78 meses' => '12']);
        Lectura::create(['sub_escala_id' => '13', 'percentil' => '90', '61-66 meses' => '3-8', '67-72 meses' => '-', '73-78 meses' => '-']);
        Lectura::create(['sub_escala_id' => '13', 'percentil' => '85', '61-66 meses' => '1-2', '67-72 meses' => '-', '73-78 meses' => '-']);
        Lectura::create(['sub_escala_id' => '13', 'percentil' => '80', '61-66 meses' => '-', '67-72 meses' => '10-11', '73-78 meses' => '-']);
        Lectura::create(['sub_escala_id' => '13', 'percentil' => '75', '61-66 meses' => '-', '67-72 meses' => '6-9', '73-78 meses' => '-']);
        Lectura::create(['sub_escala_id' => '13', 'percentil' => '70', '61-66 meses' => '-', '67-72 meses' => '3-5', '73-78 meses' => '11']);
        Lectura::create(['sub_escala_id' => '13', 'percentil' => '65', '61-66 meses' => '-', '67-72 meses' => '1-2', '73-78 meses' => '-']);
        Lectura::create(['sub_escala_id' => '13', 'percentil' => '60', '61-66 meses' => '-', '67-72 meses' => '-', '73-78 meses' => '10']);
        Lectura::create(['sub_escala_id' => '13', 'percentil' => '55', '61-66 meses' => '-', '67-72 meses' => '-', '73-78 meses' => '9']);
        Lectura::create(['sub_escala_id' => '13', 'percentil' => '50', '61-66 meses' => '-', '67-72 meses' => '-', '73-78 meses' => '7-8']);
        Lectura::create(['sub_escala_id' => '13', 'percentil' => '45', '61-66 meses' => '-', '67-72 meses' => '-', '73-78 meses' => '5-6']);
        Lectura::create(['sub_escala_id' => '13', 'percentil' => '40', '61-66 meses' => '0', '67-72 meses' => '-', '73-78 meses' => '1-4']);
        Lectura::create(['sub_escala_id' => '13', 'percentil' => '35', '61-66 meses' => 'NULL', '67-72 meses' => '-', '73-78 meses' => '-']);
        Lectura::create(['sub_escala_id' => '13', 'percentil' => '30', '61-66 meses' => 'NULL', '67-72 meses' => '0', '73-78 meses' => '-']);
        Lectura::create(['sub_escala_id' => '13', 'percentil' => '25', '61-66 meses' => 'NULL', '67-72 meses' => 'NULL', '73-78 meses' => '0']);
    }
}
