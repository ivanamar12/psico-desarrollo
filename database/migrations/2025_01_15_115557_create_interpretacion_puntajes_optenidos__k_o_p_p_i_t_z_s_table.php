<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterpretacionPuntajesOptenidosKOPPITZSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interpretacion_puntajes_optenidos__k_o_p_p_i_t_z_s', function (Blueprint $table) {
            $table->id();
            $table->string('puntaje_dfh',);
            $table->string('nivel_capacidad_mental',);
            $table->string('CI',);
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
        Schema::dropIfExists('interpretacion_puntajes_optenidos__k_o_p_p_i_t_z_s');
    }
}
