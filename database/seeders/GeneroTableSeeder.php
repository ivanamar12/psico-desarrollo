<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genero; 

class GeneroTableSeeder extends Seeder
{
    public function run()
    {
        Genero::create(['genero' => 'Masculino']);
        Genero::create(['genero' => 'Femenino']);
    }
}
