<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtencionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atencions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_escala_id')->nullable();
            $table->foreign('sub_escala_id')->references('id')->on('sub_escalas')->onDelete('cascade');
            $table->string('percentil',);
            $table->string('36-42 meses',);
            $table->string('43-48 meses',);
            $table->string('49-54 meses',);
            $table->string('55-60 meses',);
            $table->string('61-66 meses',);
            $table->string('67-78 meses',);
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
        Schema::dropIfExists('atencions');
    }
}
