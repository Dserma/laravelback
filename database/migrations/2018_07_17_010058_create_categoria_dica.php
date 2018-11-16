<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaDica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('categoria_dica', function(Blueprint $table){
        $table->unsignedInteger('categoria_id');
        $table->foreign('categoria_id')->references('id')->on('categorias');
        $table->unsignedInteger('dica_id');
        $table->foreign('dica_id')->references('id')->on('dicas');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('categoria_dica');
    }
}
