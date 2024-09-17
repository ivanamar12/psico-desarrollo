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
            $table->unsignedBigInteger('lugar_id')->nullable();
           $table->foreign('lugar_id')->references('id')->on('lugar_nacimientos')->onDelete('cascade');

           $table->unsignedBigInteger('representante_id')->nullable();
           $table->foreign('representante_id')->references('id')->on('representantes')->onDelete('cascade');

           $table->unsignedBigInteger('padre_id')->nullable();
           $table->foreign('padre_id')->references('id')->on('padres')->onDelete('cascade');

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
