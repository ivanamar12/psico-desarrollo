<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAplicacionPruebasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('aplicacion_pruebas', function (Blueprint $table) {
      $table->id();
      $table->json('resultados'); // Las respuestas crudas/item por item
      $table->json('resultados_finales'); // Puntajes, interpretaciones, conclusiones
      $table->foreignId('prueba_id')->constrained();
      $table->foreignId('especialista_id')->constrained();
      $table->foreignId('paciente_id')->constrained();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('aplicacion_pruebas');
  }
}
