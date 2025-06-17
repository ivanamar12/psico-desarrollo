<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubEscalasTable extends Migration
{
    public function up()
    {
        Schema::create('sub_escalas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prueba_id')
                  ->nullable()
                  ->constrained('pruebas')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->string('sub_escala',65);
            $table->string('descripcion',700);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_escalas');
    }
}
