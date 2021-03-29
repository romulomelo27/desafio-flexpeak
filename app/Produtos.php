<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $table = "produtos";

    protected $fillable = [

        "id",
        "nome",
        "preco",
        "id_categoria",
        "ativo",
        "descricao",
        "imagem1"
    ];
}
