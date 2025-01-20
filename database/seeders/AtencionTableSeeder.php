<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Atencion;

class AtencionTableSeeder extends Seeder
{
    public function run()
    {
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '99', '36-42 meses' => '19-20', '43-48 meses' => '19-20', '49-54 meses' => '19-20', '55-60 meses' => '20', '61-66 meses' => '20', '67-78 meses' => 'NULL']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '98', '36-42 meses' => '18', '43-48 meses' => '18', '49-54 meses' => '-', '55-60 meses' => '19', '61-66 meses' => '19', '67-78 meses' => 'NULL']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '97', '36-42 meses' => '17', '43-48 meses' => '17', '49-54 meses' => '18', '55-60 meses' => '-', '61-66 meses' => '-', '67-78 meses' => '20']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '96', '36-42 meses' => '16', '43-48 meses' => '16', '49-54 meses' => '-', '55-60 meses' => '18', '61-66 meses' => '-', '67-78 meses' => '-']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '95', '36-42 meses' => '14-15', '43-48 meses' => '13-15', '49-54 meses' => '17', '55-60 meses' => '-', '61-66 meses' => '18', '67-78 meses' => '-']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '90', '36-42 meses' => '11-13', '43-48 meses' => '12', '49-54 meses' => '15-16', '55-60 meses' => '16-17', '61-66 meses' => '17', '67-78 meses' => '19']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '85', '36-42 meses' => '10', '43-48 meses' => '11', '49-54 meses' => '14', '55-60 meses' => '14-15', '61-66 meses' => '16', '67-78 meses' => '18']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '80', '36-42 meses' => '9', '43-48 meses' => '10', '49-54 meses' => '13', '55-60 meses' => '13', '61-66 meses' => '15', '67-78 meses' => '-']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '75', '36-42 meses' => '8', '43-48 meses' => '9', '49-54 meses' => '12', '55-60 meses' => '-', '61-66 meses' => '14', '67-78 meses' => '17']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '70', '36-42 meses' => '7', '43-48 meses' => '-', '49-54 meses' => '-', '55-60 meses' => '12', '61-66 meses' => '-', '67-78 meses' => '-']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '65', '36-42 meses' => '6', '43-48 meses' => '-', '49-54 meses' => '11', '55-60 meses' => '-', '61-66 meses' => '13', '67-78 meses' => '16']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '60', '36-42 meses' => '5', '43-48 meses' => '8', '49-54 meses' => '10', '55-60 meses' => '11', '61-66 meses' => '-', '67-78 meses' => '15']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '55', '36-42 meses' => '-', '43-48 meses' => '-', '49-54 meses' => '-', '55-60 meses' => '10', '61-66 meses' => '12', '67-78 meses' => '14']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '50', '36-42 meses' => '4', '43-48 meses' => '7', '49-54 meses' => '9', '55-60 meses' => '9', '61-66 meses' => '-', '67-78 meses' => '-']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '45', '36-42 meses' => '-', '43-48 meses' => '-', '49-54 meses' => '-', '55-60 meses' => '-', '61-66 meses' => '-', '67-78 meses' => '13']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '40', '36-42 meses' => '2-3', '43-48 meses' => '6', '49-54 meses' => '8', '55-60 meses' => '8', '61-66 meses' => '11', '67-78 meses' => '-']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '35', '36-42 meses' => '1', '43-48 meses' => '-', '49-54 meses' => '-', '55-60 meses' => '-', '61-66 meses' => '10', '67-78 meses' => '-']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '30', '36-42 meses' => '-', '43-48 meses' => '5', '49-54 meses' => '7', '55-60 meses' => '-', '61-66 meses' => '-', '67-78 meses' => '12']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '25', '36-42 meses' => '-', '43-48 meses' => '-', '49-54 meses' => '6', '55-60 meses' => '7', '61-66 meses' => '9', '67-78 meses' => '-']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '20', '36-42 meses' => '-', '43-48 meses' => '4', '49-54 meses' => '-', '55-60 meses' => '6', '61-66 meses' => '8', '67-78 meses' => '11']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '15', '36-42 meses' => '0', '43-48 meses' => '2-3', '49-54 meses' => '5', '55-60 meses' => '5', '61-66 meses' => '7', '67-78 meses' => '9-10']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '10', '36-42 meses' => 'NULL', '43-48 meses' => '1', '49-54 meses' => '-', '55-60 meses' => '4', '61-66 meses' => '6', '67-78 meses' => '8']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '5', '36-42 meses' => 'NULL', '43-48 meses' => '0', '49-54 meses' => '4', '55-60 meses' => '3', '61-66 meses' => '5', '67-78 meses' => '6-7']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '4', '36-42 meses' => 'NULL', '43-48 meses' => 'NULL', '49-54 meses' => '3', '55-60 meses' => '2', '61-66 meses' => '3-4', '67-78 meses' => '5']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '3', '36-42 meses' => 'NULL', '43-48 meses' => 'NULL', '49-54 meses' => '2', '55-60 meses' => '1', '61-66 meses' => '2', '67-78 meses' => '-']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '2', '36-42 meses' => 'NULL', '43-48 meses' => 'NULL', '49-54 meses' => '-', '55-60 meses' => '0', '61-66 meses' => '1', '67-78 meses' => '1-4']);
        Atencion::create(['sub_escala_id' => '12', 'percentil' => '1', '36-42 meses' => 'NULL', '43-48 meses' => 'NULL', '49-54 meses' => '0', '55-60 meses' => 'NULL', '61-66 meses' => '0', '67-78 meses' => '0']);
    }
}
