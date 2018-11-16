<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pessoa')->unsigned();
            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();
            $table->string('ie')->nullable();
            $table->string('nome')->nullable();
            $table->date('nascimento')->nullable();
            $table->string('profissao')->nullable();
            $table->string('nome_conjuge')->nullable();
            $table->string('cpf_conjuge')->nullable();
            $table->string('rg_conjuge')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('razao')->nullable();
            $table->string('fantasia')->nullable();
            $table->string('email')->unique();
            $table->string('telefones');
            $table->string('logradouro')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('uf',2)->nullable();
            $table->string('cep',9)->nullable();
            $table->text('anotacoes')->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
