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
        <h3><b>Ranking Fragância Utilizada</b></h3>
        @if(session('status_cadastro'))
            <div class="alert alert-info">
                {{ session('status_cadastro') }}
            </div>
        @endif
        <br>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Posição</th>
                    <th>Nome</th>
                    <th>Qtd Utilizada</th>
                </tr>
            </thead>
            <tbody>
                @php
                $posicao=1;
                @endphp
                @foreach ($ranking as $produto)
                    <tr>
                        <td>{{$posicao}} °</td>
                        <td>{{$produto->nome}}</td>
                        <td>{{$produto->qtd_utilizado}} (ML)</td>
                    </tr>
                @php
                $posicao ++;
                @endphp
                @endforeach
            </tbody>
        </table>
        <hr>
        * Ordenado pelo quantidade utilizada
        <hr>

    </div>
</div>


@endsection

@section('script')
<script src="{{asset('js/fabricar-produto.js')}}"></script>
@endsection
