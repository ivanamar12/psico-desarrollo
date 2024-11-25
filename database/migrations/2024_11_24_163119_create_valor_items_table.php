<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valor_items', function (Blueprint $table) {
            $table->id();
            $table->string('valor',);
            $table->string('interpretacion',);
            $table->unsignedBigInteger('item_prueba_id')->nullable();
            $table->foreign('item_prueba_id')->references('id')->on('item_pruebas')->onDelete('cascade');
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
        Schema::dropIfExists('valor_items');
    }
}
