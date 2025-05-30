<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntecedenteMedicosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('antecedente_medicos', function (Blueprint $table) {
      $table->id();
      $table->string('enfermedad_infecciosa',);
      $table->string('tipo_enfermedad_infecciosa',);
      $table->string('enfermedad_no_infecciosa',);
      $table->string('tipo_enfermedad_no_infecciosa',);
      $table->string('enfermedad_cronica',);
      $table->string('tipo_enfermedad_cronica',);
      $table->string('discapacidad',);
      $table->string('tipo_discapacidad',);
      $table->string('otros', 600);
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
    Schema::dropIfExists('antecedente_medicos');
  }
}
