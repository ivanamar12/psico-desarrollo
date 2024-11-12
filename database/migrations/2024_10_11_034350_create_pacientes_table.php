<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',120);
            $table->string('apellido',120);
            $table->date('fecha_nac');
            $table->unsignedBigInteger('representante_id')->nullable();
            $table->foreign('representante_id')->references('id')->on('representantes')->onDelete('cascade');
            $table->unsignedBigInteger('datoseconomico_id')->nullable();
            $table->foreign('datoseconomico_id')->references('id')->on('datos_economicos')->onDelete('cascade');
            $table->unsignedBigInteger('genero_id')->nullable();
            $table->foreign('genero_id')->references('id')->on('generos')->onDelete('cascade');
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
        Schema::dropIfExists('pacientes');
    }
}
