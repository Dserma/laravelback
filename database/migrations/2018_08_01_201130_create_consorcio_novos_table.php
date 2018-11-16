<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsorcioNovosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consorcio_novos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('legenda');
            $table->text('conteudo');
            $table->string('imagem');
            $table->string('icone_vantagem');
            $table->text('vantagem');
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
        Schema::dropIfExists('consorcio_novos');
    }
}
