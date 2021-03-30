@extends('dashboard.blank')

@section('atalho')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page">Listar Ingredientes</li>
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
        <b>LISTA DE INGREDIENTES</b>
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
                        <th>Estoque</th>
                        <th>Unidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ingredientes as $ingred)
                    <tr>
                        <td>{{$ingred->id}}</td>
                        <td>{{$ingred->nome}}</td>
                        <td>{{ $ingred->estoque}}</td>
                        <td>{{ $ingred->unidade}}</td>
                        <td class="text-center">
                            <a href="{{url('/produtos/editar-ingrediente/'.$ingred->id)}}" class="btn btn-primary btn-sm" title="Editar">
                                <i class="fas fa-pen"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{ $ingredientes->links() }} --}}
        </div>
    </div>
</div>

@endsection

@section('script')
{{-- <script src="{{asset('js/validar-empresa.js')}}"></script> --}}
@endsection
