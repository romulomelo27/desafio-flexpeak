<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Empresas;
use App\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{
    public function index(Request $request, CarrinhoController $carrinho)
    {
        $dados_get = $request->all();

        $categorias = Categorias::where('ativo', '1')->orderBy('nome', 'asc')->get();

        $vetor_empresas = Empresas::all();

        if (count($vetor_empresas)) {

            $empresa = $vetor_empresas[0];
        } else {

            $empresa = null;
        }



        $por_pagina = 10;

        $produtos = DB::table('produtos')->join('categorias', 'produtos.id_categoria', '=', 'categorias.id')
            ->select('produtos.*', 'categorias.nome as categoria')->where('produtos.ativo', '1')->where('categorias.ativo', '1')
            ->paginate($por_pagina);

        $paginas = $this->paginacao($por_pagina);

        $pagina_atual = !isset($dados_get["page"]) ? 1 : $dados_get["page"];

        $pedido = json_decode($carrinho->getValorPedido());

        // dd($categorias);

        return view('delivery.home', compact('categorias', 'empresa', 'produtos', 'paginas', 'pagina_atual', 'pedido'));
    }

    /** Houve a necessidade de implementar esse funcao por estar usando materialize em vez de bootstrap no delivery */
    protected function paginacao($por_pagina, $busca = "")
    {

        $buscar_ativos = DB::select("select count(*) qtd from produtos p inner join categorias c on (p.id_categoria = c.id)
                    where p.ativo = 1 and c.ativo = 1 and p.nome like ?", ["%" . $busca . "%"]);

        $total_paginas = $buscar_ativos[0]->qtd / $por_pagina;

        return $total_paginas;
    }

    public function novoCliente(CarrinhoController $carrinho)
    {
        $categorias = Categorias::where('ativo', '1')->orderBy('nome', 'asc')->get();

        $pedido = json_decode($carrinho->getValorPedido()); // valor do pedido

        return view('delivery.novo-cliente', compact('categorias', 'pedido'));
    }
}
