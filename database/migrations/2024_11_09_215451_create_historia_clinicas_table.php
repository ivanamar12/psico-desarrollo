<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriaClinicasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('historia_clinicas', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('paciente_id')->nullable();
      $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
      $table->unsignedBigInteger('historia_desarrollo_id')->nullable();
      $table->foreign('historia_desarrollo_id')->references('id')->on('historia_desarrollos')->onDelete('cascade');
      $table->unsignedBigInteger('antecedente_medico_id')->nullable();
      $table->foreign('antecedente_medico_id')->references('id')->on('antecedente_medicos')->onDelete('cascade');
      $table->unsignedBigInteger('historia_escolar_id')->nullable();
      $table->foreign('historia_escolar_id')->references('id')->on('historia_escolars')->onDelete('cascade');
      $table->string('codigo',);
      $table->string('referencia',);
      $table->string('especialista_refirio',);
      $table->string('motivo',);
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
    Schema::dropIfExists('historia_clinicas');
  }
}
