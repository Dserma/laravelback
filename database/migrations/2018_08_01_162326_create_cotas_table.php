<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if(Schema::hasTable('cotas')) return;
        Schema::create('cotas', function (Blueprint $table) {
          $table->increments('id');
          $table->enum('tipo', ['1','2','3']);
          $table->unsignedInteger('administradora_id');
          $table->foreign('administradora_id')->references('id')->on('administradoras');
          $table->float('credito',20,2);
          $table->float('entrada',20,2);
          $table->float('juros');
          $table->enum('status', ['0','1','2','3']);
          $table->float('valor_investidor')->nullable();
          $table->integer('agrupada')->default('0');
          $table->integer('destaque')->unsigned()->default(0);
          $table->text('infos')->nullable();
          $table->float('entrada_opicional')->nullable();
          $table->string('cota')->nullable();
          $table->string('grupo')->nullable();
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
      Schema::dropIfExists('cotas');
    }
}
