<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecretariasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('secretarias', function (Blueprint $table) {
      $table->id();
      $table->string('nombre', 120);
      $table->string('apellido', 120);
      $table->string('ci', 30)->unique();
      $table->date('fecha_nac');
      $table->string('grado', 120);
      $table->string('telefono', 12)->unique();
      $table->string('email');
      $table->foreignId('user_id')->constrained();
      $table->foreignId('genero_id')->constrained();
      $table->foreignId('direccion_id')->constrained();
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
    Schema::dropIfExists('secretarias');
  }
}
