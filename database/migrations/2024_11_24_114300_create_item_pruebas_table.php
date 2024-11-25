<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemPruebasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_pruebas', function (Blueprint $table) {
            $table->id();
            $table->string('item',);
            $table->unsignedBigInteger('prueba_id')->nullable();
            $table->foreign('prueba_id')->references('id')->on('pruebas')->onDelete('cascade');
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
        Schema::dropIfExists('item_pruebas');
    }
}
