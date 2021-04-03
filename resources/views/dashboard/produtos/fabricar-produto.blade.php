@extends('dashboard.blank')

@section('atalho')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page">Fabricar Produto</li>
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
        <h3><b>Fabricar: {{$produto->nome}} ({{number_format($frasco[0]->qtd,2,',','.')}} ML)</b></h3>
        @if(session('status_cadastro'))
            <div class="alert alert-info">
                {{ session('status_cadastro') }}
            </div>
        @endif
        <br>
        <p style="text-align: center"><b>Ingredientes e quantidade em estoque</b></p>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Ingrediente</th>
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
                        <td>{{number_format($ingred->qtd_ingrediente,3,',','.')}}</td>
                        <td>{{$ingred->unidade_ingrediente}}</td>
                        <td>{{number_format($ingred->estoque,3,',','.')}}</td>
                        <td>{{$ingred->unidade_estoque}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <h5><b>Estoque produzido: {{$em_estoque[0]->qtd == null ? 0 : $em_estoque[0]->qtd}} (ML)</b></h5>
        <hr>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="ml_fabricar">Informe a Quantidade (ML)</label>
                    <input type="text" class="form-control" autofocus id="mlFabricar">
                    <input type="hidden" id="idProduto" value="{{$produto->id}}">
                    <input type="hidden" id="nomeProduto" value="{{$produto->nome}}">
                    <input type="hidden" id="link" value="{{url('/')}}">
                    <a href="#" class="btn btn-primary btn-sm btn-disponibilidade" style="margin-top: 5px">Verif. Disponibilidade</a>
                </div>
                <p id="#load"><i class='fa fa-spinner fa-spin' style='font-size:20px; display:none'></i></p>
            </div>
            <div class="col-md-8">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Ingrediente</th>
                            <th>Necessário</th>
                            <th>Disponível</th>
                            <th>Pode Fabricar</th>
                        </tr>
                    </thead>
                    <tbody id="ingredienteDisponibilidade"></tbody>
                </table>
            </div>
            <div class="col-md-2">
                <a href="{{url('/produtos/finalizar-fabricacao')}}" style="display: none" id="btnFinalizarFabricacao" class="btn btn-success">Finalizar Produção</a>
            </div>
        </div>
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <td>Fabricado</td>
                    <td>Data</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($historico_fabricacao as $historico)
                <tr>
                    <td>{{$historico->quantidade_fabricado}} (ML)</td>
                    <td>{{$historico->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection

@section('script')
<script src="{{asset('js/fabricar-produto.js')}}"></script>
@endsection
