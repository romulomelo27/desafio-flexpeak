@extends('dashboard.blank')

@section('atalho')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page">Detalhes Produto</li>
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
        <h3><b>{{$produto->nome}} ({{$frasco[0]->qtd}} ML)</b></h3>
        <hr>
        @if(session('status_cadastro'))
            <div class="alert alert-info">
                {{ session('status_cadastro') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-4">
                <b>Imagem</b><br>
                <img src="{{asset('/storage/'.$produto->imagem1)}}" width="300px">
            </div>
            <div class="col-md-8">
                <b>Ingredientes</b><br><br>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Qtd</th>
                            <th>Und Produto</th>
                            <th>Qtd Estoque</th>
                            <th>Und Estoque</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ingredientes as $ingred)
                            <tr>
                                <td>{{$ingred->nome}}</td>
                                <td>{{$ingred->qtd_ingrediente}}</td>
                                <td>{{$ingred->unidade_ingrediente}}</td>
                                <td>{{$ingred->estoque}}</td>
                                <td>{{$ingred->unidade_estoque}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <h5>{{$produto->descricao}}</h5>
    </div>
</div>


@endsection

@section('script')
<script src="{{asset('js/validar-produtos.js')}}"></script>
@endsection
