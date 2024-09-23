<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriaEscolarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historia_escolars', function (Blueprint $table) {
            $table->id();
            $table->string('escolarizado',);
            $table->string('tipo_educaion',);
            $table->string('tutoria_terapias',);
            $table->string('tutoria_terapias_cuales',);
            $table->string('dificultad_lectura',);
            $table->string('dificultad_aritmetica',);
            $table->string('dificultad_escribir',);
            $table->string('agrada_escuela',);
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
        Schema::dropIfExists('historia_escolars');
    }
}
