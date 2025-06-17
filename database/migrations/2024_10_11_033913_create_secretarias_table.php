<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecretariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secretarias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',120);
            $table->string('apellido',120);
            $table->string('ci',30);
            $table->date('fecha_nac');
            $table->string('grado',120);
            $table->string('telefono',30);
            $table->string('email',120);
           $table->unsignedBigInteger('genero_id')->nullable();
           $table->foreign('genero_id')->references('id')->on('generos')->onDelete('cascade');
           $table->unsignedBigInteger('direccion_id')->nullable();
           $table->foreign('direccion_id')->references('id')->on('direccions')->onDelete('cascade');
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
        Schema::dropIfExists('secretarias');
    }
}
