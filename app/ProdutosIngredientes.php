<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutosIngredientes extends Model
{
    protected $table = 'produtos_ingredientes';
    protected $primaryKey = ['id_produto', 'id_ingrediente'];
    public $incrementing = false;
    protected $fillable = ['id_produto', 'id_ingrediente', 'quantidade', 'unidade'];
}
