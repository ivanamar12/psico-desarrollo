<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('citas', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('paciente_id')->nullable();
      $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');

      $table->unsignedBigInteger('especialista_id')->nullable();
      $table->foreign('especialista_id')->references('id')->on('especialistas')->onDelete('cascade');

      $table->date('fecha_consulta');
      $table->string('hora',);
      $table->string('status',);
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
    Schema::dropIfExists('citas');
  }
}
