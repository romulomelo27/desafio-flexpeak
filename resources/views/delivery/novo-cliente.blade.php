@extends('delivery.blank')

@section('conteudo')

  <br><br><br>
  <div class="row">
    <div class="col s12 m12">
      <div class="card z-depth-5">
        <div class="card-content">
            <span class="card-title"><b>Criar Conta</b></span>
            <div class="row">
                <form class="col s12" class="z-depth-4" action="{{url('/criar-conta')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="nome" type="text" class="validate">
                            <label for="nome">Nome Completo</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="email" type="email" class="validate">
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="senha" type="password" class="validate">
                            <label for="senha">Senha</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="confirme_senha" type="password" class="validate">
                            <label for="confirme_senha">Confirme  Senha</label>
                        </div>
                    </div>
                    <p class="grey lighten-3">Endereço</p>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="cep" type="text" class="validate">
                            <label for="cep">CEP</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="rua" type="text" class="validate">
                            <label for="rua">Rua</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="numero" type="text" class="validate">
                            <label for="numero">Número</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="bairro" type="text" class="validate">
                            <label for="bairro">Bairro</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="cidade" type="text" class="validate">
                            <label for="cidade">Cidade</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
    <script src="{{asset('js/carrinho.js')}}"></script>
@endsection
