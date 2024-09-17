<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePadresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('padres', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_mama',120);
            $table->string('apellido_mama',120);
            $table->string('ci_mama',30);
            $table->date('fecha_nac_mama');
            $table->string('grado_mama',120);
            $table->string('telefono_mama',30);
            $table->string('email_mama',120);
            $table->string('nombre_papa',120);
            $table->string('apellido_papa',120);
            $table->string('ci_papa',30);
            $table->date('fecha_nac_papa');
            $table->string('grado_papa',120);
            $table->string('telefono_papa',30);
            $table->string('email_papa',120);
            $table->string('estado_civil',120);
            $table->string('custodia_niño',120);
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
        Schema::dropIfExists('padres');
    }
}
