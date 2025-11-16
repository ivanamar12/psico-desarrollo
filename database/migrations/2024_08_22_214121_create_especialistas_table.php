<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspecialistasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('especialistas', function (Blueprint $table) {
      $table->id();
      $table->string('nombre', 120);
      $table->string('apellido', 120);
      $table->string('ci', 30)->unique();
      $table->date('fecha_nac');
      $table->string('telefono', 12)->unique();
      $table->string('email');
      $table->string('fvp', 120);
      $table->foreignId('user_id')
        ->constrained();
      $table->foreignId('genero_id')
        ->constrained();
      $table->unsignedBigInteger('especialidad_id')->nullable();
      $table->foreign('especialidad_id')->references('id')->on('especialidads')->onDelete('cascade');
      $table->unsignedBigInteger('direccion_id')->nullable();
      $table->foreign('direccion_id')->references('id')->on('direccions')->onDelete('cascade');
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
    Schema::dropIfExists('especialistas');
  }
}
