@extends('dashboard.blank')

@section('atalho')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page">Novo Ingrediente</li>
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
        <b>DADOS INGREDIENTE</b>
        <hr>
        @if(session('status_edicao'))
            <div class="alert alert-info">
                {{ session('status_edicao') }}
            </div>
        @endif
        <form action="{{url('/produtos/salvar-edicao-ingrediente')}}" id="frm-cadastrar-ingrediente" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$ingrediente->id}}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="nome">Nome Ingrediente</label>
                        <input type="text" name="nome" value="{{$ingrediente->nome}}" class="form-control" autofocus maxlength="60">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="unidade">Unidade</label>
                        <select class="form-control" name="unidade">
                            {{-- <option value="KILOS">KILOS</option> --}}
                            <option value="LITROS">LITROS</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="estoque">Estoque</label>
                        <input type="text" name="estoque" value="{{$ingrediente->estoque}}" required class="form-control" autofocus maxlength="60">
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
