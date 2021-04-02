@extends('dashboard.blank')

@section('atalho')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page">Listar Produtos</li>
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
        <b>LISTA DE PRODUTOS</b>
        <hr>
        @if(session('status_cadastro'))
            <div class="alert alert-info">
                {{ session('status_cadastro') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Frasco</th>
                        <th>Unidade</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtos as $produto)
                    <tr>
                        <td>{{$produto->id}}</td>
                        <td>{{$produto->nome}}</td>
                        <td>{{ number_format($produto->quantidade,2,',','.')}}</td>
                        <td>{{$produto->unidade}}</td>
                        <td>{{ $produto->ativo == "1" ? 'Ativo' : 'Inativo'}}</td>
                        <td class="text-center">
                            <a href="{{url('/produtos/fabricar/'.$produto->id)}}" class="btn btn-primary btn-sm" title="Fabricar Produto">
                                <i class="fas fa-industry"></i>
                            </a>
                            <a href="{{url('/produtos/editar/'.$produto->id)}}" class="btn btn-primary btn-sm" title="Editar">
                                <i class="fas fa-pen"></i>
                            </a>
                            <a href="{{url('/produtos/detalhes/'.$produto->id)}}" class="btn btn-primary btn-sm" title="Detalhes">
                                <b>(  i  )</b>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $produtos->links() }}
        </div>
    </div>
</div>

@endsection

@section('script')
{{-- <script src="{{asset('js/validar-empresa.js')}}"></script> --}}
@endsection
