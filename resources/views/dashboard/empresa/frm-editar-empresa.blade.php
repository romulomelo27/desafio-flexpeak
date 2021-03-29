@extends('dashboard.blank')

@section('atalho')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page">Empresa</li>
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
        <b>EDITAR DADOS EMPRESA</b>
        <hr>
        @if($status_cadastro != null)
            <div class="alert alert-info">
                {{ $status_cadastro }}
            </div>
        @endif
        @if (session('status_edicao'))
            <div class="alert alert-info">
                {{ session('status_edicao') }}
            </div>
        @endif
        <form action="{{url('/empresa/salvar-edicao')}}" id="frm-cadastrar-empresa" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{url('/')}}" id="link">
            <input type="hidden" value="{{$empresa->id}}" name="id">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="razao_social">Razão Social</label>
                        <input type="text" name="razao_social" class="form-control" value="{{$empresa->razao_social}}" maxlength="100" autofocus>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nome_fantasia">Nome Fantasia</label>
                        <label style="color: red">*</label>
                        <input type="text" name="nome_fantasia" class="form-control" value="{{$empresa->nome_fantasia}}" maxlength="100" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="apelido">Apelido</label>
                    <input type="text" name="apelido" class="form-control" value="{{$empresa->apelido}}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cnpj">CNPJ</label>
                        <input type="text" name="cnpj" class="form-control" id="cnpj" value="{{$empresa->cnpj}}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cep">
                            CEP
                            <i class='fa fa-spinner fa-spin icon-load-cep' style='font-size:20px; display:none'></i>
                        </label>
                        <input type="text" name="cep" class="form-control" id="cep" value="{{$empresa->cep}}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="estado">
                            Estado
                        </label>
                        <input type="text" name="estado" maxlength="40" class="form-control" id="estado" value="{{$empresa->estado}}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" name="cidade" maxlength="40" class="form-control" id="cidade" value="{{$empresa->cidade}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="bairro">Bairro</label>
                        <input type="text" name="bairro" maxlength="60" class="form-control" id="bairro" value="{{$empresa->bairro}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="rua">Rua</label>
                    <input type="text" name="rua" id="rua" maxlength="100" class="form-control" value="{{$empresa->rua}}">
                </div>
                <div class="col-md-2">
                    <label for="numero">Número</label>
                    <input type="text" name="numero" id="numero" maxlength="6" class="form-control" value="{{$empresa->numero}}">
                </div>
                <div class="col-md-4">
                    <label for="numero">Complemento</label>
                    <input type="text" name="complemento" id="complemento" class="form-control" value="{{$empresa->complemento}}">
                </div>
            </div>
            <div class="row" style="margin-top: 10px">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Telefone1">Telefone 1</label>
                        <input type="text" name="telefone1" id="telefone1" class="form-control" value="{{$empresa->telefone1}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Telefone2">Telefone 2</label>
                        <input type="text" name="telefone2" id="telefone2" class="form-control" value="{{$empresa->telefone2}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="whatsapp1">whatsapp 1</label>
                        <input type="text" name="whatsapp1" id="whatsapp1" class="form-control" value="{{$empresa->whatsapp1}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="whatsapp2">whatsapp 2</label>
                        <input type="text" name="whatsapp2" id="whatsapp2" class="form-control" value="{{$empresa->whatsapp2}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label>Dias e Horário de Funcionamento</label><br>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="segunda" name="segunda" value="1" {{$empresa->segunda == "1" ? 'checked':''}}>Segunda
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="terca" name="terca" value="1" {{$empresa->terca == "1" ? 'checked':''}}>Terça
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="quarta" name="quarta" value="1" {{$empresa->quarta == "1" ? 'checked':''}}>Quarta
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="quinta" name="quinta" value="1" {{$empresa->quinta == "1" ? 'checked':''}}>Quinta
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="sexta" name="sexta" value="1" {{$empresa->sexta == "1" ? 'checked':''}}>Sexta
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="sabado" name="sabado" value="1" {{$empresa->sabado == "1" ? 'checked':''}}>Sábado
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="domingo" name="domingo" value="1" {{$empresa->domingo == "1" ? 'checked':''}}>Domingo
                        </label>
                    </div>
                </div>
            </div>
            <br>
            <div class="row" id="hora_segunda" {{$empresa->segunda == "1" ? "":"style=display:none"}}>
                <div class="col-md-12">
                    <label>Horário Segunda</label><br>
                    De: <input type="time" name="segunda_hora_inicio" value="{{$empresa->segunda_hora_inicio}}"> à <input type="time" name="segunda_hora_fim" value="{{$empresa->segunda_hora_fim}}">
                </div>
            </div>
            <div class="row" id="hora_terca" {{$empresa->terca == "1" ? "":"style=display:none"}}>
                <div class="col-md-12">
                    <label>Horário Terça</label><br>
                    De: <input type="time" name="terca_hora_inicio" value="{{$empresa->terca_hora_inicio}}"> à <input type="time" name="terca_hora_fim" value="{{$empresa->terca_hora_fim}}">
                </div>
            </div>
            <div class="row" id="hora_quarta" {{$empresa->quarta == "1" ? "":"style=display:none"}}>
                <div class="col-md-12">
                    <label>Horário Quarta</label><br>
                    De: <input type="time" name="quarta_hora_inicio" value="{{$empresa->quarta_hora_inicio}}"> à <input type="time" name="quarta_hora_fim" value="{{$empresa->quarta_hora_fim}}">
                </div>
            </div>
            <div class="row" id="hora_quinta" {{$empresa->quinta == "1" ? "":"style=display:none"}}>
                <div class="col-md-12">
                    <label>Horário Quinta</label><br>
                    De: <input type="time" name="quinta_hora_inicio" value="{{$empresa->quinta_hora_inicio}}"> à <input type="time" name="quinta_hora_fim" value="{{$empresa->quinta_hora_fim}}">
                </div>
            </div>
            <div class="row" id="hora_sexta" {{$empresa->sexta == "1" ? "":"style=display:none"}}>
                <div class="col-md-12">
                    <label>Horário Sexta</label><br>
                    De: <input type="time" name="sexta_hora_inicio" value="{{$empresa->sexta_hora_inicio}}"> à <input type="time" name="sexta_hora_fim" value="{{$empresa->sexta_hora_fim}}">
                </div>
            </div>
            <div class="row" id="hora_sabado" {{$empresa->sabado == "1" ? "":"style=display:none"}}>
                <div class="col-md-12">
                    <label>Horário Sabado</label><br>
                    De: <input type="time" name="sabado_hora_inicio" value="{{$empresa->sabado_hora_inicio}}"> à <input type="time" name="sabado_hora_fim" value="{{$empresa->sabado_hora_fim}}">
                </div>
            </div>
            <div class="row" id="hora_domingo" {{$empresa->domingo == "1" ? "":"style=display:none"}}>
                <div class="col-md-12">
                    <label>Horário Domingo</label><br>
                    De: <input type="time" name="domingo_hora_inicio" value="{{$empresa->domingo_hora_inicio}}"> à <input type="time" name="domingo_hora_fim" value="{{$empresa->domingo_hora_fim}}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="logo">Logo</label><br>
                        <img src="{{url('storage/'.$empresa->logo) }}" width="200px" >
                        <input type="hidden" name="logo_old" value="{{$empresa->logo}}">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="logo">Nova Logo</label>
                        <input type="file" name="logo" class="form-control">
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
<script src="{{asset('js/validar-empresa.js')}}"></script>
@endsection
