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
        <b>DADOS EMPRESA</b>
        <hr>
        @if(session('status_cadastro'))
            <div class="alert alert-info">
                {{ session('status_cadastro') }}
            </div>
        @endif
        <form action="{{url('/empresa/salvar')}}" id="frm-cadastrar-empresa" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{url('/')}}" id="link">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="razao_social">Razão Social</label>
                        <input type="text" name="razao_social" class="form-control" maxlength="100" autofocus>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nome_fantasia">Nome Fantasia</label>
                        <label style="color: red">*</label>
                        <input type="text" name="nome_fantasia" class="form-control" maxlength="100" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="apelido">Apelido</label>
                    <input type="text" name="apelido" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cnpj">CNPJ</label>
                        <input type="text" name="cnpj" class="form-control" id="cnpj">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cep">
                            CEP
                            <i class='fa fa-spinner fa-spin icon-load-cep' style='font-size:20px; display:none'></i>
                        </label>
                        <input type="text" name="cep" class="form-control" id="cep">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="estado">
                            Estado
                        </label>
                        <input type="text" name="estado" maxlength="40" class="form-control" id="estado">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" name="cidade" maxlength="40" class="form-control" id="cidade">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="bairro">Bairro</label>
                        <input type="text" name="bairro" maxlength="60" class="form-control" id="bairro">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="rua">Rua</label>
                    <input type="text" name="rua" id="rua" maxlength="100" class="form-control">
                </div>
                <div class="col-md-2">
                    <label for="numero">Número</label>
                    <input type="text" name="numero" id="numero" maxlength="6" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="numero">Complemento</label>
                    <input type="text" name="complemento" id="complemento" class="form-control">
                </div>
            </div>
            <div class="row" style="margin-top: 10px">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Telefone1">Telefone 1</label>
                        <input type="text" name="telefone1" id="telefone1" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Telefone2">Telefone 2</label>
                        <input type="text" name="telefone2" id="telefone2" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="whatsapp1">whatsapp 1</label>
                        <input type="text" name="whatsapp1" id="whatsapp1" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="whatsapp2">whatsapp 2</label>
                        <input type="text" name="whatsapp2" id="whatsapp2" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label>Dias e Horário de Funcionamento</label><br>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="segunda" name="segunda" value="1">Segunda
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="terca" name="terca" value="1">Terça
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="quarta" name="quarta" value="1">Quarta
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="quinta" name="quinta" value="1">Quinta
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="sexta" name="sexta" value="1">Sexta
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="sabado" name="sabado" value="1">Sábado
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="domingo" name="domingo" value="1">Domingo
                        </label>
                    </div>
                </div>
            </div>
            <br>
            <div class="row" id="hora_segunda" style="display: none">
                <div class="col-md-12">
                    <label>Horário Segunda</label><br>
                    De: <input type="time" name="segunda_hora_inicio"> à <input type="time" name="segunda_hora_fim">
                </div>
            </div>
            <div class="row" id="hora_terca" style="display: none">
                <div class="col-md-12">
                    <label>Horário Terça</label><br>
                    De: <input type="time" name="terca_hora_inicio"> à <input type="time" name="terca_hora_fim">
                </div>
            </div>
            <div class="row" id="hora_quarta" style="display: none">
                <div class="col-md-12">
                    <label>Horário Quarta</label><br>
                    De: <input type="time" name="quarta_hora_inicio"> à <input type="time" name="quarta_hora_fim">
                </div>
            </div>
            <div class="row" id="hora_quinta" style="display: none">
                <div class="col-md-12">
                    <label>Horário Quinta</label><br>
                    De: <input type="time" name="quinta_hora_inicio"> à <input type="time" name="quinta_hora_fim">
                </div>
            </div>
            <div class="row" id="hora_sexta" style="display: none">
                <div class="col-md-12">
                    <label>Horário Sexta</label><br>
                    De: <input type="time" name="sexta_hora_inicio"> à <input type="time" name="sexta_hora_fim">
                </div>
            </div>
            <div class="row" id="hora_sabado" style="display: none">
                <div class="col-md-12">
                    <label>Horário Sabado</label><br>
                    De: <input type="time" name="sabado_hora_inicio"> à <input type="time" name="sabado_hora_fim">
                </div>
            </div>
            <div class="row" id="hora_domingo" style="display: none">
                <div class="col-md-12">
                    <label>Horário Domingo</label><br>
                    De: <input type="time" name="domingo_hora_inicio"> à <input type="time" name="domingo_hora_fim">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="logo">Logo</label>
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
