<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('delivery.home');
// });

Route::get('/', 'DeliveryController@index');
Route::get('/entrar', 'DeliveryController@entrar');
Route::get('/criar-conta', 'DeliveryController@novoCliente');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'empresa'], function () {
    Route::get('/', 'EmpresasController@index');
    Route::post('/salvar', 'EmpresasController@salvarEmpresa');
    Route::post('/salvar-edicao', 'EmpresasController@salvarEdicaoEmpresa');
});

Route::group(['prefix' => 'produtos'], function () {
    Route::get('/', 'ProdutosController@listarProdutos');
    Route::get('/nova-categoria', 'ProdutosController@novaCategoria');
    Route::post('/salvar-categoria', 'ProdutosController@salvarCategoria');
    Route::get('/categorias', 'ProdutosController@listarCategorias');
    Route::get('/editar-categoria/{id}', 'ProdutosController@editarCategoria');
    Route::post('/salvar-edicao-categoria', 'ProdutosController@salvarEdicaoCategoria');
    Route::get('/novo', 'ProdutosController@novoProduto');
    Route::post('/salvar', 'ProdutosController@salvarProduto');
    Route::get('/editar/{id}', 'ProdutosController@editarProduto');
    Route::post('/salvar-edicao-produto', 'ProdutosController@salvarEdicaoProduto');
    Route::get('/novo-ingrediente', 'ProdutosController@novoIngrediente');
    Route::post('/novo-ingrediente', 'ProdutosController@salvarIngrediente');
    Route::get('/ingredientes', 'ProdutosController@listarIngredientes');
    Route::get('/editar-ingrediente/{id_produto}', 'ProdutosController@editarIngrediente');
    Route::post('/salvar-edicao-ingrediente', 'ProdutosController@salvarEdicaoIngrediente');
});

Route::group(['prefix' => 'carrinho'], function () {
    Route::get('/', 'CarrinhoController@verCarrinho');
    Route::get('/adicionar-item-pedido/{id_produto}', 'CarrinhoController@adicionarItemPedido');
    Route::get('/remover-item-pedido/{posicao_produto}', 'CarrinhoController@removerItemPedido');
    Route::get('/itens-pedido', 'CarrinhoController@getPedido');
    Route::get('/diminuir-quantidade-item/{id_produto}', 'CarrinhoController@diminuirQuantidadeItem');
});
