<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParcelasCotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if(Schema::hasTable('parcelas_cotas')) return;
        Schema::create('parcelas_cotas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cota_id');
            $table->foreign('cota_id')->references('id')->on('cotas')->onDelete('cascade');
            $table->integer('parcelas');
            $table->float('valor_parcela',20,2);
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
        Schema::dropIfExists('parcelas_cotas');
    }
}
