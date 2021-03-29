<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('razao_social')->nullable();
            $table->string('nome_fantasia')->nullable();
            $table->string('apelido')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('cep')->nullable();
            $table->string('estado')->nullable();
            $table->string('cidade')->nullable();
            $table->string('bairro')->nullable();
            $table->string('rua')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('telefone1')->nullable();
            $table->string('telefone2')->nullable();
            $table->string('whatsapp1')->nullable();
            $table->string('whatsapp2')->nullable();
            $table->string('logo')->nullable();
            $table->char('segunda', 1)->nullable();
            $table->char('terca', 1)->nullable();
            $table->char('quarta', 1)->nullable();
            $table->char('quinta', 1)->nullable();
            $table->char('sexta', 1)->nullable();
            $table->char('sabado', 1)->nullable();
            $table->char('domingo', 1)->nullable();
            $table->time('segunda_hora_inicio')->nullable();
            $table->time('segunda_hora_fim')->nullable();
            $table->time('terca_hora_inicio')->nullable();
            $table->time('terca_hora_fim')->nullable();
            $table->time('quarta_hora_inicio')->nullable();
            $table->time('quarta_hora_fim')->nullable();
            $table->time('quinta_hora_inicio')->nullable();
            $table->time('quinta_hora_fim')->nullable();
            $table->time('sexta_hora_inicio')->nullable();
            $table->time('sexta_hora_fim')->nullable();
            $table->time('sabado_hora_inicio')->nullable();
            $table->time('sabado_hora_fim')->nullable();
            $table->time('domingo_hora_inicio')->nullable();
            $table->time('domingo_hora_fim')->nullable();
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
        Schema::dropIfExists('empresas');
    }
}
