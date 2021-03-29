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
        @if(session('status_edicao'))
            <div class="alert alert-info">
                {{ session('status_edicao') }}
            </div>
        @endif
        <form action="{{url('/produtos/salvar-edicao-produto')}}" id="frm-cadastrar-produto" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$produto->id}}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="nome">Nome*</label>
                        <input type="text" name="nome" value="{{$produto->nome}}" class="form-control" autofocus maxlength="60" autocomplete="off" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="preco">Preço*</label>
                        <input type="text" name="preco" id="preco" value="{{$produto->preco}}" class="form-control" autocomplete="off" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nome">Categoria*</label>
                        <select name="id_categoria" class="form-control" required>
                            <option value="">Selecione</option>
                            @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}" {{$produto->id_categoria == $categoria->id ? "selected":""}}>
                                {{$categoria->nome}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="ativo">
                            <option value="1" {{$produto->ativo == "1" ? "selected":""}}>Ativo</option>
                            <option value="0" {{$produto->ativo == "0" ? "selected":""}}>Inativo</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea name="descricao"  class="form-control">{{$produto->descricao}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="logo">Imagem</label><br>
                        <img src="{{url('storage/'.$produto->imagem1) }}" width="200px" >
                        <input type="hidden" name="imagem1_old" value="{{$produto->imagem1}}">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="imagem1">Nova Imagem</label>
                        <input type="file" name="imagem1"  class="form-control">
                    </div>
                </div>
            </div>
            <br>
            <input type="submit" class="btn btn-primary btn-block" value="Salvar">
        </form>
    </div>
</div>

@endsection

@section('script')
<script src="{{asset('js/validar-produtos.js')}}"></script>
@endsection
