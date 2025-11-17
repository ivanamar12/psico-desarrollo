<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDireccionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('direccions', function (Blueprint $table) {
      $table->id();
      $table->string('sector', 150);
      $table->foreignId('estado_id')->constrained();
      $table->foreignId('municipio_id')->constrained();
      $table->foreignId('parroquia_id')->constrained();
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
    Schema::dropIfExists('direccions');
  }
}
