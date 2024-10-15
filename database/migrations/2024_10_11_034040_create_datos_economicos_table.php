<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosEconomicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_economicos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_vivienda',);
            $table->string('cantidad_habitaciones',);
            $table->string('cantidad_personas',);
            $table->string('servecio_agua_potable',);
            $table->string('servecio_gas',);
            $table->string('servecio_electricidad',);
            $table->string('servecio_drenaje',);
            $table->string('disponibilidad_internet',);
            $table->string('tipo_conexion_internet',);
            $table->string('acceso_servcios_publicos',);
            $table->string('fuente_ingreso_familiar',);
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
        Schema::dropIfExists('datos_economicos');
    }
}
