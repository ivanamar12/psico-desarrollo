<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferenciasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('referencias', function (Blueprint $table) {
      $table->id();
      $table->date('fecha_emision');
      $table->date('fecha_vencimiento');
      $table->string('titulo')->default('REFERENCIA A NEUROLOGÍA');
      $table->text('motivo')->nullable();
      $table->text('presentacion_caso')->nullable();
      $table->text('antecedentes')->nullable();
      $table->text('indicadores_psicologicos')->nullable();
      $table->text('sugerencias')->nullable();
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
    Schema::dropIfExists('referencias');
  }
}
