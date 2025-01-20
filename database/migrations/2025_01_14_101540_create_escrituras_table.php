<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscriturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escrituras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_escala_id')->nullable();
            $table->foreign('sub_escala_id')->references('id')->on('sub_escalas')->onDelete('cascade');
            $table->string('percentil',);
            $table->string('61-66 meses',);
            $table->string('67-72 meses',);
            $table->string('73-78 meses',);
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
        Schema::dropIfExists('escrituras');
    }
}
