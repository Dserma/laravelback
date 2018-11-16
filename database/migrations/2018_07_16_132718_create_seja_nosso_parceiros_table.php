<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSejaNossoParceirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seja_nosso_parceiros', function (Blueprint $table) {
            $table->increments('id');
            $table->text('legenda');
            $table->text('conteudo');
            $table->text('oferecemos_imoveis');
            $table->text('oferecemos_veiculos');
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
        Schema::dropIfExists('seja_nosso_parceiros');
    }
}
