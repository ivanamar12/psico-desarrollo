<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePruebasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pruebas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',);
            $table->string('descripcion',);
            $table->string('status',);
            $table->unsignedBigInteger('tipo_prueba_id')->nullable();
            $table->foreign('tipo_prueba_id')->references('id')->on('tipo_pruebas')->onDelete('cascade');
            $table->unsignedBigInteger('area_desarrollo_id')->nullable();
            $table->foreign('area_desarrollo_id')->references('id')->on('area_desarrollos')->onDelete('cascade');
            $table->unsignedBigInteger('rango_prueba_id')->nullable();
            $table->foreign('rango_prueba_id')->references('id')->on('rango_pruebas')->onDelete('cascade');
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
        Schema::dropIfExists('pruebas');
    }
}
