<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaleconoscosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fale_conosco', function (Blueprint $table) {
            $table->increments('id');
            $table->text('legenda');
            $table->string('icone_atendimento');
            $table->text('atendimento');
            $table->string('icone_email');
            $table->text('email');
            $table->string('icone_parceiro');
            $table->text('parceiro');
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
        Schema::dropIfExists('fale_conosco');
    }
}
