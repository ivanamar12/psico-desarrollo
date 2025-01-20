<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Escritura;

class EscrituraTableSeeder extends Seeder
{
    public function run()
    {
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '99', '61-66 meses' => '7-12', '67-72 meses' => '12', '73-78 meses' => '12']);
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '98', '61-66 meses' => '6', '67-72 meses' => '-', '73-78 meses' => '-']);
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '97', '61-66 meses' => '5', '67-72 meses' => '-', '73-78 meses' => '-']);
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '96', '61-66 meses' => '4', '67-72 meses' => '-', '73-78 meses' => '-']);
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '95', '61-66 meses' => '3', '67-72 meses' => '11', '73-78 meses' => '-']);
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '90', '61-66 meses' => '2', '67-72 meses' => '10', '73-78 meses' => '11']);
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '85', '61-66 meses' => '-', '67-72 meses' => '9', '73-78 meses' => '-']);
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '80', '61-66 meses' => '1', '67-72 meses' => '7-8', '73-78 meses' => '10']);
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '75', '61-66 meses' => '-', '67-72 meses' => '4-6', '73-78 meses' => '9']);
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '70', '61-66 meses' => '-', '67-72 meses' => '1-3', '73-78 meses' => '-']);
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '65', '61-66 meses' => '-', '67-72 meses' => '1-2', '73-78 meses' => '-']);
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '60', '61-66 meses' => '-', '67-72 meses' => '-', '73-78 meses' => '8']);
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '55', '61-66 meses' => '0', '67-72 meses' => '-', '73-78 meses' => '7']);
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '50', '61-66 meses' => '-', '67-72 meses' => '-', '73-78 meses' => '6']);
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '45', '61-66 meses' => '-', '67-72 meses' => '-', '73-78 meses' => '5']);
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '40', '61-66 meses' => '0', '67-72 meses' => '-', '73-78 meses' => '3-4']);
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '35', '61-66 meses' => 'NULL', '67-72 meses' => '0', '73-78 meses' => '2']);
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '30', '61-66 meses' => 'NULL', '67-72 meses' => 'NULL', '73-78 meses' => '1']);
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '25', '61-66 meses' => 'NULL', '67-72 meses' => 'NULL', '73-78 meses' => '-']);
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '20', '61-66 meses' => 'NULL', '67-72 meses' => 'NULL', '73-78 meses' => '-']);
        Escritura::create(['sub_escala_id' => '14', 'percentil' => '15', '61-66 meses' => 'NULL', '67-72 meses' => 'NULL', '73-78 meses' => '0']);
    }
}
