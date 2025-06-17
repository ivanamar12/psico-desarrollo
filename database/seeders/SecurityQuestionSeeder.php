<?php

namespace Database\Seeders;

use App\Models\SecurityQuestion;
use Illuminate\Database\Seeder;

class SecurityQuestionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $questions = [
      '¿Cuál es el nombre de tu primera mascota?',
      '¿Cuál es el nombre de tu colegio de primaria?',
      '¿Cuál es tu comida favorita?',
      '¿Cuál es el nombre de tu ciudad natal?',
      '¿Cuál es el segundo nombre de tu madre?'
    ];

    foreach ($questions as $question) {
      SecurityQuestion::create(['question' => $question]);
    }
  }
}
