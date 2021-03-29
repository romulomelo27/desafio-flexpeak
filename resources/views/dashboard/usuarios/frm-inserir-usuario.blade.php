@extends('dashboard.blank')

@section('atalho')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page">Usuários</li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{url('usuarios/novoUsuario')}}">Novo Usuário</a></li>
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
        <b>NOVO USUÁRIO</b>
        <hr>
        @if(session('status_cadastro'))
            <div class="alert alert-info">
                {{ session('status_cadastro') }}
            </div>
        @endif
        <form action="{{url('/usuarios/novoUsuario')}}" id="frm-cadastrar-usuario" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{url('/')}}" id="link">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label for="name">Nome Usuário</label>
                        <label style="color: red">*</label>
                        <input type="text" name="name" class="form-control" maxlength="100" autofocus required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <label style="color: red">*</label>
                        <input type="text" name="email" class="form-control" maxlength="100" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <label style="color: red">*</label>
                        <input type="password" name="password" id="password" class="form-control" maxlength="80" required maxlength="255">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label for="confirme_password">Confirmar Senha</label>
                        <label style="color: red">*</label>
                        <input type="password" name="confirme_password" id="confirme_password" class="form-control" maxlength="80" required maxlength="255">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label for="foto_usuario">Foto</label>
                        <input type="file" name="foto_usuario" class="form-control">
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" id="btn-novo-usuario" value="Salvar">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
    <script src="{{asset('js/validar-usuario.js')}}"></script>
@endsection
