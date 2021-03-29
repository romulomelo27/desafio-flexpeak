<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    protected $table = "empresas";

    protected $fillable = [

        'id',
        'razao_social',
        'nome_fantasia',
        'apelido',
        'cnpj',
        'cep',
        'estado',
        'cidade',
        'bairro',
        'rua',
        'numero',
        'complemento',
        'telefone1',
        'telefone2',
        'whatsapp1',
        'whatsapp2',
        'logo',
        'segunda',
        'terca',
        'quarta',
        'quinta',
        'sexta',
        'sabado',
        'domingo',
        'segunda_hora_inicio',
        'segunda_hora_fim',
        'terca_hora_inicio',
        'terca_hora_fim',
        'quarta_hora_inicio',
        'quarta_hora_fim',
        'quinta_hora_inicio',
        'quinta_hora_fim',
        'sexta_hora_inicio',
        'sexta_hora_fim',
        'sabado_hora_inicio',
        'sabado_hora_fim',
        'domingo_hora_inicio',
        'domingo_hora_fim'
    ];
}
