<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSobrenosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sobrenos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('legenda');
            $table->string('imagem');
            $table->text('conteudo');
            $table->string('icone_missao');
            $table->text('missao');
            $table->string('icone_visao');
            $table->text('visao');
            $table->string('icone_valores');
            $table->text('valores');
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
        Schema::dropIfExists('sobrenos');
    }
}
