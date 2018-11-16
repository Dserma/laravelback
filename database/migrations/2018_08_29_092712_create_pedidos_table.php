<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tipo');
            $table->unsignedInteger('cota_id');
            $table->unsignedInteger('cliente_id')->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('set null');
            $table->foreign('cota_id')->references('id')->on('cotas')->onDelete('cascade');
            $table->string('nome');
            $table->string('telefone')->nullable();
            $table->string('celular');
            $table->string('email');
            $table->integer('status');
            $table->dateTime('data_rejeicao')->nullable();
            $table->dateTime('data_aprovacao')->nullable();
            $table->text('motivo_rejeicao')->nullable();
            $table->float('entrada_negociada')->nullable();
            $table->date('data_sinal')->nullable();
            $table->float('valor_sinal')->nullable();
            $table->date('data_pagamento_final')->nullable();
            $table->float('valor_pagamento_final')->nullable();
            $table->date('data_entrega_transferencia')->nullable();
            $table->string('sedex')->nullable();
            $table->float('valor_comissao')->nullable();
            $table->text('observacoes')->nullable();
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
        Schema::dropIfExists('pedidos');
    }
}
