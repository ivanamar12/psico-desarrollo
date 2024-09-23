<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriaDesarrollosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historia_desarrollos', function (Blueprint $table) {
            $table->id();
            $table->string('medicamento_embarazo',);
            $table->string('tipo_medicamento',800);
            $table->string('fumo_embarazo',);
            $table->string('cantidad',);
            $table->string('alcohol_embarazo',);
            $table->string('tipo_alcohol',);
            $table->string('cantidad_consumia_alcohol',);
            $table->string('droga_embarazo',);
            $table->string('tipo_droga',);
            $table->string('forceps_parto',);
            $table->string('cesarea',);
            $table->string('razon_cesarea',900);
            $table->string('niño_prematuro',);
            $table->string('meses_prematuro',);
            $table->string('peso_nacer_niño',);
            $table->string('complicaciones_nacer',);
            $table->string('tipo_complicacion',900);
            $table->string('problema_alimentacion',);
            $table->string('tipo_problema_alimenticio',900);
            $table->string('problema_dormir',);
            $table->string('tipo_problema_dormir',900);
            $table->string('tranquilo_recien_nacido',);
            $table->string('gustaba_cargaran_recien_nacido',);
            $table->string('alerta_recien_nacido',);
            $table->string('problemas_desarrollo_primeros_años',);
            $table->string('cuales_problemas',1000);
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
        Schema::dropIfExists('historia_desarrollos');
    }
}
