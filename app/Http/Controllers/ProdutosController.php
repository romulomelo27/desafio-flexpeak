<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;
use App\Produtos;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Ingredientes;
use App\ProdutosIngredientes;

class ProdutosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function novaCategoria()
    {
        return view('dashboard.produtos.frm-nova-categoria');
    }

    public function salvarCategoria(Request $request)
    {
        try {

            $dados_categoria = $request->all();

            if ($this->buscarCategoria($dados_categoria['nome']) == false) {

                unset($dados_categoria['_token']);
                Categorias::create($dados_categoria);
                Log::info("nova  categoria criada: " . $dados_categoria['nome'] . " Usuario: " . Auth::user()->name);
                return redirect('/produtos/nova-categoria')->with(["status_cadastro" => "Categoria cadastrada com sucesso"]);
            } //
            else //
            {
                return redirect('/produtos/nova-categoria')->with(["status_cadastro" => "A categoria {$dados_categoria['nome']} já existe"]);
            }
        } //
        catch (Exception $e) {

            Log::error("erro ao criar nova categoria: " . $e->getMessage());
            return redirect('/produtos/nova-categoria')->with(["status_cadastro" => "erro ao criar nova categoria: " . $e->getMessage()]);
        }
    }

    public function buscarCategoria($busca)
    {
        $busca = str_replace(' ', '', $busca);
        $categorias = DB::select("select count(*) qtd from categorias where replace(nome,' ','') = ?", [$busca]);
        $count = $categorias[0]->qtd;
        return $count > 0 ? true : false;
    }

    public function listarCategorias()
    {
        $categorias = Categorias::paginate(20);

        return view('dashboard.produtos.listar-categorias', compact('categorias'));
    }

    public function editarCategoria($id)
    {
        $categoria = Categorias::find($id);

        return view('dashboard.produtos.frm-editar-categoria', compact('categoria'));
    }

    public function salvarEdicaoCategoria(Request $request)
    {
        try {

            $dados_categoria = $request->all();
            unset($dados_categoria['_token']);
            DB::table('categorias')->where('id', $dados_categoria['id'])->update($dados_categoria);
            Log::info('Categoria id:' . $dados_categoria['id'] . ' editada pelo usuario:' . Auth::user()->name);
            return redirect('/produtos/editar-categoria/' . $dados_categoria['id'])->with(['status_edicao' => 'Editado com sucesso']);
        } //
        catch (Exception $e) {

            Log::error("erro ao editar categoria: " . $e->getMessage());
            return redirect('/produtos/editar-categoria/' . $dados_categoria['id'])->with(["status_edicao" => "erro ao editar categoria: " . $e->getMessage()]);
        }
    }

    // ROTINAS PARA PRODUTOS

    public function novoProduto()
    {
        if (session()->has("ingredientes")) {

            session()->forget("ingredientes");
        }

        $categorias = Categorias::where('ativo', '1')->orderBy('nome', 'asc')->get();

        $ingredientes = Ingredientes::all();

        return view('dashboard.produtos.frm-novo-produto', compact('categorias', 'ingredientes'));
    }

    public function ingredienteTemporario(Request $request)
    {

        // session()->forget("ingredientes");

        // return '';

        $ingrediente = $request->all();

        if (session()->has("ingredientes")) {

            $ingredientesTemp = session("ingredientes");

            $posicao_ingrediente = array_search($ingrediente['id_ingrediente'], array_column($ingredientesTemp, 'id_ingrediente'));

            if ($posicao_ingrediente === false) {

                $ingredientesTemp[] = $ingrediente;

                session(["ingredientes" => $ingredientesTemp]);
            } //
            else //
            {
                return json_encode(["status" => "Ingrediente já adicionado"]);
            }
        } //
        else {

            $ingredientesTemp[] = $ingrediente;

            session(["ingredientes" => $ingredientesTemp]);
        }

        return json_encode($ingredientesTemp);
    }

    public function removerIngredienteTemporario($posicao_ingrediente)
    {

        $ingredientesTemp = session("ingredientes");

        unset($ingredientesTemp[$posicao_ingrediente]);

        session(["ingredientes" => $ingredientesTemp]);

        return json_encode($ingredientesTemp);
    }

    public function salvarProduto(Request $request)
    {

        $dados_produto = $request->all();

        $dados_produto['preco'] = $this->setFormatoAmericano($dados_produto['preco']);

        try {

            if (isset($dados_produto["imagem1"])) {
                $logo = str_replace("public/", "", $request->file("imagem1")->store("public/produtos"));
                $dados_produto["imagem1"] = $logo;
            }
            unset($dados_produto['_token']);
            DB::beginTransaction();
            $getCadastro = Produtos::create($dados_produto);
            $getCadastro->id;

            if (session()->has("ingredientes")) {

                $ingredientesTemp = session("ingredientes");

                foreach ($ingredientesTemp as $ingrediente) {

                    $ingrediente['id_produto'] = $getCadastro->id;

                    // dd($ingrediente);

                    ProdutosIngredientes::create($ingrediente);
                }
            }

            DB::commit();
            Log::info("Novo produto criado: " . $dados_produto['nome'] . " Usuario: " . Auth::user()->name);
            return redirect('/produtos/novo')->with(["status_cadastro" => "Produto cadastrado com sucesso"]);
        } //
        catch (Exception $e) {

            DB::rollBack();
            Log::error("erro ao criar novo produto: " . $e->getMessage());
            return redirect('/produtos/novo')->with(["status_cadastro" => "erro ao criar novo produto: " . $e->getMessage()]);
        }
    }

    private function setFormatoAmericano($valor)
    {

        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", ".", $valor);

        $valor = (float) $valor;

        return $valor;
    }

    public function listarProdutos()
    {
        // $produtos = Produtos::paginate(20);

        $produtos = DB::table('produtos')
            ->join('produtos_ingredientes', 'produtos.id', 'produtos_ingredientes.id_produto')
            ->select('produtos.id', 'produtos.nome', 'preco', 'ativo', 'unidade', DB::raw('sum(quantidade) as quantidade'))
            ->groupBy('produtos.id', 'produtos.nome', 'preco', 'ativo', 'unidade')
            ->paginate(20);


        // dd($produtos);

        return view('dashboard.produtos.listar-produtos', compact('produtos'));
    }

    public function editarProduto($id)
    {
        $produto = Produtos::find($id);

        $produto->preco = $this->setFormatoBrasileiro($produto->preco);

        $categorias = Categorias::where('ativo', '1')->orderBy('nome', 'asc')->get();

        return view('dashboard.produtos.frm-editar-produto', compact('produto', 'categorias'));
    }

    private function setFormatoBrasileiro($valor)
    {

        $valor = str_replace(".", ",", $valor);

        return $valor;
    }

    public function salvarEdicaoProduto(Request $request)
    {

        try {

            $dados_produto = $request->all();

            if (isset($dados_produto['imagem1'])) {
                Storage::delete('public/' . $dados_produto['imagem1_old']);
                $dados_produto['imagem1'] = str_replace("public/", "", $request->file("imagem1")->store("public/produtos"));
            }
            unset($dados_produto['imagem1_old']);
            unset($dados_produto['_token']);
            $dados_produto['preco'] = $this->setFormatoAmericano($dados_produto['preco']);
            DB::table('produtos')->where('id', $dados_produto['id'])->update($dados_produto);
            Log::info('Produto id:' . $dados_produto['id'] . ' editado pelo usuario:' . Auth::user()->name);
            return redirect('/produtos/editar/' . $dados_produto['id'])->with(['status_edicao' => 'Editado com sucesso']);
        } //
        catch (Exception $e) {

            Log::error('Erro ao editar produto:' . $e->getMessage());
            return redirect('/produtos/editar/' . $dados_produto['id'])->with(['status_edicao' => 'Erro ao editar:' . $e->getMessage()]);
        }
    }

    public function detalhesProduto($id)
    {
        $produto = Produtos::find($id);

        $ingredientes = DB::select("SELECT nome, pi.quantidade as qtd_ingrediente,pi.unidade as unidade_ingrediente, estoque,i.unidade as unidade_estoque FROM produtos_ingredientes
                    pi INNER join ingredientes i on (pi.id_ingrediente = i.id) where pi.id_produto = ?", [$id]);

        $frasco = DB::select("select sum(quantidade) qtd from produtos_ingredientes where id_produto = ?", [$id]);

        return view('dashboard.produtos.frm-detalhes-produto', compact('produto', 'ingredientes', 'frasco'));
    }

    public function novoIngrediente()
    {

        return view('dashboard.produtos.frm-novo-ingrediente');
    }

    public function salvarIngrediente(Request $request)
    {
        $ingrediente = $request->all();

        unset($ingrediente['_token']);

        try {

            Ingredientes::create($ingrediente);

            return redirect('/produtos/novo-ingrediente')->with(['status_cadastro' => 'Ingrediente cadastrado']);
        } catch (Exception $e) {

            return redirect('/produtos/novo-ingrediente')->with(['status_cadastro' => $e->getMessage()]);
        }
    }

    public function listarIngredientes()
    {

        $ingredientes = Ingredientes::all();

        return view('dashboard.produtos.listar-ingredientes', compact('ingredientes'));
    }

    public function editarIngrediente($id_produto)
    {

        $ingrediente = Ingredientes::find($id_produto);

        return view('dashboard.produtos.frm-editar-ingrediente', compact('ingrediente'));
    }

    public function salvarEdicaoIngrediente(Request $request)
    {

        try {

            $dados_ingrediente = $request->all();
            unset($dados_ingrediente['_token']);
            DB::table('ingredientes')->where('id', $dados_ingrediente['id'])->update($dados_ingrediente);
            Log::info('Ingrediente id:' . $dados_ingrediente['id'] . ' editada pelo usuario:' . Auth::user()->name);
            return redirect('/produtos/editar-ingrediente/' . $dados_ingrediente['id'])->with(['status_edicao' => 'Editado com sucesso']);
        } //
        catch (Exception $e) {

            Log::error("erro ao editar ingrediente: " . $e->getMessage());
            return redirect('/produtos/editar-ingrediente/' . $dados_ingrediente['id'])->with(["status_edicao" => "erro ao editar ingrediente: " . $e->getMessage()]);
        }
    }
}
