@extends('dashboard.blank')

@section('atalho')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page">Listar Categorias</li>
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
        <b>LISTA DE CATEGORIAS</b>
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
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categ)
                    <tr>
                        <td>{{$categ->id}}</td>
                        <td>{{$categ->nome}}</td>
                        <td>{{ $categ->ativo == "1" ? 'Ativo' : 'Inativo'}}</td>
                        <td class="text-center">
                            <a href="{{url('/produtos/editar-categoria/'.$categ->id)}}" class="btn btn-primary btn-sm" title="Editar">
                                <i class="fas fa-pen"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $categorias->links() }}
        </div>
    </div>
</div>

@endsection

@section('script')
{{-- <script src="{{asset('js/validar-empresa.js')}}"></script> --}}
@endsection
