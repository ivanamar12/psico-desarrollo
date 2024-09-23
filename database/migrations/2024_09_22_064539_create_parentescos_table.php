<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentescosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parentescos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('datosocioeconomico_id')->nullable();
            $table->foreign('datosocioeconomico_id')->references('id')->on('datos_socioeconomicos')->onDelete('cascade');
            $table->string('nombre',120);
            $table->string('apellido',120);
            $table->date('fecha_nac');
            $table->string('parentesco',120);
            $table->string('discapacidad',120);
            $table->string('tipo_discapacidad',120);
            $table->string('enfermedad_cronica',120);
            $table->string('tipo_enfermedad',120);
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
        Schema::dropIfExists('parentescos');
    }
}
