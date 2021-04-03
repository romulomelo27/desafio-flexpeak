<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    public function produtoFabricado()
    {
        $ranking = DB::select("select p.nome, sum(quantidade_fabricado) total_fabricado, count(*) quantidade_fabricacoes
                from fabricacoes f inner join produtos p on(p.id = f.id_produto)
                group by id_produto, p.nome order by sum(quantidade_fabricado) desc;
                ");

        return view('dashboard.ranking.produto-fabricado', compact('ranking'));
    }
}
