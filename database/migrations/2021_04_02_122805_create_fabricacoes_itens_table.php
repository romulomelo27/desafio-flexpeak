<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFabricacoesItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fabricacoes_itens', function (Blueprint $table) {
            $table->integer('id_fabricacao');
            $table->integer('id_ingrediente');
            $table->string('nome_ingrediente');
            $table->integer('quantidade');
            $table->timestamps();
            $table->primary(['id_fabricacao', 'id_ingrediente']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fabricacoes_itens');
    }
}
