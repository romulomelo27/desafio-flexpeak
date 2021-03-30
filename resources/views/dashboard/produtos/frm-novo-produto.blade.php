@extends('dashboard.blank')

@section('atalho')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page">Novo Produto</li>
  </ol>
</nav>
@endsection

@section('conteudo')
<!-- Page content -->
<style>
.invalid{
    color:red;
    font-size: 14px;
}
</style>
<div class="card">
    <div class="card-body">
        <b>NOVO PRODUTO</b>
        <hr>
        @if(session('status_cadastro'))
            <div class="alert alert-info">
                {{ session('status_cadastro') }}
            </div>
        @endif
        <form action="{{url('/produtos/salvar')}}" id="frm-cadastrar-produto" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="link" value="{{url('/')}}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="nome">Nome*</label>
                        <input type="text" name="nome" class="form-control" autofocus maxlength="60" autocomplete="off" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="preco">Preço*</label>
                        <input type="text" name="preco" id="preco" class="form-control" autocomplete="off" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nome">Categoria*</label>
                        <select name="id_categoria" class="form-control" required>
                            <option value="">Selecione</option>
                            @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="ativo">
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <b>Lista de Ingredientes</b>
                    <br><br>
                    <div style="max-height: 150px; overflow-y: scroll;">
                        <table class="table table-striped table-sm">
                            <tbody>
                                @foreach ($ingredientes as $ingred)
                                <tr>
                                    <td>{{$ingred->nome}}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm vincular-ingrediente"
                                        data-id-ingrediente="{{$ingred->id}}"
                                        data-nome-ingrediente="{{$ingred->nome}}"
                                        data-target="#modalIngrediente"
                                        href="#" style="float: right">Add</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <b>Ingredientes do Produto</b>
                    <br><br>
                    <table class="table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Qtd</th>
                                <th>Und</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody id="ingredientesProduto">
                            <tr>
                                <td>Vazio</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea name="descricao"  class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="imagem1">Imagem</label>
                        <input type="file" name="imagem1"  class="form-control">
                    </div>
                </div>
            </div>
            <br>
            <input type="submit" class="btn btn-primary btn-block" value="Salvar">
        </form>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="modalIngrediente">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Informe a quantidade necessária</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <input id="idIngrediente" type="hidden" value="">
        <input id="nomeIngrediente" type="hidden" value="">
        <h5 id="nomeIngredienteModal"></h5>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="quantidade">Quantidade</label>
                    <input type="text" id="qtdIngrediente" class="form-control">
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <label for="unidade">Unidade</label>
                    <select id="unidadeIngrediente" class="form-control">
                        <option value="mililitro">Mililitro(s)</option>
                        <option value="litro">Litro(s)</option>
                    </select>
                </div>
            </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary salvar-ingrediente-produto">Inserir</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
      </div>

    </div>
  </div>
</div>

@endsection

@section('script')
<script src="{{asset('js/validar-produtos.js')}}"></script>
@endsection
