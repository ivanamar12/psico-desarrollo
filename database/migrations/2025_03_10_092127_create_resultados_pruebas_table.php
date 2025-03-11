<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultadosPruebasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultados_pruebas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aplicacion_pruebas_id')
                  ->nullable()
                  ->constrained('aplicacion_pruebas')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->json('resultados_finales');
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
        Schema::dropIfExists('resultados_pruebas');
    }
}
