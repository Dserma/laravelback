<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimulacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simulacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('telefone',16);
            $table->string('celular',16);
            $table->string('email');
            $table->enum('tipo', ['1','2']);
            $table->float('credito', 20,2);
            $table->float('valor_parcela', 20,2);
            $table->float('entrada', 20,2);
            $table->enum('status', ['0','1']);
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
        Schema::dropIfExists('simulacoes');
    }
}
