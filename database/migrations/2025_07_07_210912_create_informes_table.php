<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('informes', function (Blueprint $table) {
      $table->id();
      $table->date('fecha_emision');
      $table->date('fecha_vencimiento');
      $table->json('recursos')->nullable();
      $table->json('instrumentos')->nullable();
      $table->text('condiciones_generales')->nullable();
      $table->text('fisica_salud')->nullable();
      $table->text('perceptivo_motriz')->nullable();
      $table->text('coeficiente_intelectual')->nullable();
      $table->text('afectiva_social')->nullable();
      $table->text('conclusion')->nullable();
      $table->text('recomendaciones')->nullable();
      $table->foreignId('especialista_id')
        ->constrained('especialistas');
      $table->foreignId('paciente_id')
        ->constrained('pacientes');
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
    Schema::dropIfExists('informes');
  }
}
