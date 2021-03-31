<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableProdutosIngredientesCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos_ingredientes', function (Blueprint $table) {
            $table->integer('id_produto');
            $table->integer('id_ingrediente');
            $table->decimal('quantidade', 8, 3);
            $table->primary(['id_produto', 'id_ingrediente']);
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
        Schema::dropIfExists('produtos_ingredientes');
    }
}
