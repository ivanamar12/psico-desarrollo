<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDibujoFiguraHumanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dibujo_figura_humanas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_escala_id')->nullable();
            $table->foreign('sub_escala_id')->references('id')->on('sub_escalas')->onDelete('cascade');
            $table->string('items',);
            $table->string('nivel',);
            $table->string('masculino_5_años',);
            $table->string('femenino_5_años',);
            $table->string('masculino_6_años',);
            $table->string('femenino_6_años',);
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
        Schema::dropIfExists('dibujo_figura_humanas');
    }
}
