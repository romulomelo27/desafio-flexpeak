@extends('dashboard.blank')

@section('atalho')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{url('/produtos/categorias')}}">Lista de Categorias</a></li>
    <li class="breadcrumb-item" aria-current="page">Editar Categoria</li>
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
        <b>EDITAR CATEGORIA</b>
        <hr>
        @if(session('status_edicao'))
            <div class="alert alert-info">
                {{ session('status_edicao') }}
            </div>
        @endif
        <form action="{{url('/produtos/salvar-edicao-categoria')}}" id="frm-editar-categoria" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$categoria->id}}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="nome">Nome Categoria</label>
                        <input type="text" name="nome" value="{{$categoria->nome}}" class="form-control" autofocus maxlength="60">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="ativo">
                            <option value="1" {{$categoria->ativo == "1" ? 'selected':''}}>Ativo</option>
                            <option value="0" {{$categoria->ativo == "0" ? 'selected':''}}>Inativo</option>
                        </select>
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
{{-- <script src="{{asset('js/validar-empresa.js')}}"></script> --}}
@endsection
