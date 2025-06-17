<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAplicacionPruebasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplicacion_pruebas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete(); 
            $table->foreignId('paciente_id')->constrained('pacientes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('prueba_id')->constrained('pruebas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->json('resultados');
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
        Schema::dropIfExists('aplicacion_pruebas');
    }
}
