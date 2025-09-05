<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePruebaEstandarizadasTable extends Migration
{
  public function up()
  {
    Schema::create('pruebas', function (Blueprint $table) {
      $table->id();
      $table->string('nombre', 65);
      $table->string('descripcion', 700);
      $table->enum('rango_edad', ['0-3 meses', '4-6 meses', '7-12 meses', '13-24 meses', '25-36 meses', '37-48 meses', '49-72 meses', '36-78 meses', '60-78 meses'])->default('0-3 meses'); // Cambia aquí
      $table->enum('area_desarrollo', ['Area', 'Cognitiva', 'Motora', 'Lenguaje', 'Socio-Afectiva', 'Sensorial'])->default('Area');
      $table->enum('tipo', ['Estandarizada', 'NO-Estandarizada'])->default('NO-Estandarizada');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('pruebas');
  }
}
