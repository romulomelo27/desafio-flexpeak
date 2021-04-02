<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabricacoes extends Model
{
    protected $table = 'fabricacoes';

    protected $fillable = ['id', 'id_produto', 'nome_produto', 'quantidade_fabricado'];
}
