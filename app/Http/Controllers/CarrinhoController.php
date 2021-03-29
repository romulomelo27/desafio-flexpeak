<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produtos;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Categorias;

class CarrinhoController extends Controller
{
    public function adicionarItemPedido($id_produto)
    {
        $produto = Produtos::find($id_produto);

        // session()->forget("pedido");

        if (session()->has("pedido")) {

            //recupero o pedido
            $pedido = session("pedido");
            // dd("recupera pedido", $pedido);

            $posicao_produto = array_search($id_produto, array_column($pedido, 'id_produto'));

            if ($posicao_produto === false) {

                $item['id_produto'] = $produto->id;
                $item['nome'] = $produto->nome;
                $item['descricao'] = $produto->descricao;
                $item['preco'] = (float) $produto->preco;
                $item['quantidade'] = 1;
                $item['preco_total'] = (float) $produto->preco;
                $item['tipo_venda'] = 'varejo';
                $item['id_categoria'] = $produto->id_categoria;
                $item['data_inserido'] = date('Y-m-d H:i:s');

                $pedido[] = $item;

                session(["pedido" => $pedido]);

                // return json_encode($pedido);
            } //
            else //
            {
                try {

                    $quantidade = $pedido[$posicao_produto]['quantidade'] + 1;
                    $preco_total = $quantidade * $pedido[$posicao_produto]['preco'];

                    $pedido[$posicao_produto]['quantidade'] = $quantidade; //atualizando quantidade do produto
                    $pedido[$posicao_produto]['preco_total'] = $preco_total; //atualizando preco total

                    session(["pedido" => $pedido]);

                    // return json_encode($pedido);
                } //
                catch (Exception $e) //
                {
                    Log::error("erro ao criar nova empresa: " . $e->getMessage());
                }
            }
        } //
        else {

            $item['id_produto'] = $produto->id;
            $item['nome'] = $produto->nome;
            $item['descricao'] = $produto->descricao;
            $item['preco'] = (float) $produto->preco;
            $item['quantidade'] = 1;
            $item['preco_total'] = (float) $produto->preco;
            $item['tipo_venda'] = 'varejo';
            $item['id_categoria'] = $produto->id_categoria;
            $item['data_inserido'] = date('Y-m-d H:i:s');

            $pedido[] = $item;

            session(["pedido" => $pedido]);
        }
        return $this->getValorPedido();
    }

    public function getValorPedido()
    {

        if (session()->has("pedido")) {
            //recupero o pedido
            $pedido = session("pedido");

            $valor_pedido = 0;

            foreach ($pedido as $itens) {

                $valor_pedido = $valor_pedido + $itens['preco_total'];
            }

            return json_encode(["valor_pedido" => $valor_pedido]);
        } else {
            return json_encode(["valor_pedido" => 0]);
        }
    }

    public function getPedido()
    {

        if (session()->has("pedido")) {
            //recupero o pedido
            $pedido = session("pedido");

            return json_encode($pedido);
        } //
        else //
        {
            return null;
        }
    }

    public function verCarrinho()
    {
        $categorias = Categorias::where('ativo', '1')->orderBy('nome', 'asc')->get();

        $pedido = json_decode($this->getValorPedido()); // valor do pedido

        $itens_carrinho = json_decode($this->getPedido());

        // dd($itens_carrinho);

        return view('delivery.ver-carrinho', compact('categorias', 'pedido', 'itens_carrinho'));
    }

    public function removerItemPedido($posicao_produto)
    {
        if (session()->has("pedido")) {
            //recupero o pedido
            $pedido = session("pedido");

            unset($pedido[$posicao_produto]);

            session(["pedido" => $pedido]);

            return redirect('/carrinho');
        } //
        else //
        {
            return redirect('/');
        }
    }

    public function diminuirQuantidadeItem($id_produto)
    {

        if (session()->has("pedido")) {

            try {

                //recupero o pedido
                $pedido = session("pedido");

                $posicao_produto = array_search($id_produto, array_column($pedido, 'id_produto'));

                $quantidade = $pedido[$posicao_produto]["quantidade"] - 1;

                //quanidade minima deve ser 1
                $quantidade = ($quantidade <= 0 ? 1 : $quantidade);

                $preco_total = $pedido[$posicao_produto]["preco"] * $quantidade;

                //atualizando
                $pedido[$posicao_produto]["quantidade"] =  (float)$quantidade;
                $pedido[$posicao_produto]["preco_total"] = (float)$preco_total;

                session(["pedido" => $pedido]);

                return $this->getValorPedido();
            } //
            catch (Exception $e) {

                return json_encode(["status" => $e->getMessage()]);
            }
        }
    }
}
