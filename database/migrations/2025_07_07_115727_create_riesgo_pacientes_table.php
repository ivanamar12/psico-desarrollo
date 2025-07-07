<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiesgoPacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riesgo_pacientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('historia_clinica_id');
            $table->float('riesgo_social')->nullable();
            $table->float('riesgo_biologico')->nullable();
            $table->string('riesgo_global')->nullable(); // 'bajo', 'medio', 'alto'
            $table->timestamps();

            $table->foreign('historia_clinica_id')
                  ->references('id')
                  ->on('historia_clinicas')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riesgo_pacientes');
    }
}
