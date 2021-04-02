<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FabricacoesItens extends Model
{
    protected $table = 'fabricacoes_itens';
    protected $primaryKey = ['id_fabricacao', 'id_ingrediente'];
    public $incrementing = false;
    protected $fillable = ['id_fabricacao', 'id_ingrediente', 'nome_ingrediente', 'quantidade'];
}
