<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentantesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('representantes', function (Blueprint $table) {
      $table->id();
      $table->string('nombre', 120);
      $table->string('apellido', 120);
      $table->string('ci', 30)->unique();
      $table->string('telefono', 12)->unique();
      $table->string('email');
      $table->unsignedBigInteger('genero_id')->nullable();
      $table->foreign('genero_id')->references('id')->on('generos')->onDelete('cascade');
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
    Schema::dropIfExists('representantes');
  }
}
