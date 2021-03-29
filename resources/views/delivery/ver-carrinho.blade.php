@extends('delivery.blank')

@section('conteudo')
<br><br><br>
      <h5><b>Carrinho</b></h5>
      @auth
          <div class="row">
            <div class="col s12 green lighten-3">
                <p>Olá, <b>{{Auth::user()->name}}</b></p>
            </div>
        </div>
      @else
        <div class="row">
            <div class="col s12 yellow lighten-3">
                <p><b>Olá, Você precisa estar logado para finalizar o pedido. <a href="{{url('/entrar')}}">Entrar</a> | <a href="{{url('/criar-conta')}}">Criar Conta</a></b></p>
            </div>
        </div>
      @endauth
      <table class="responsive-table striped">
        <thead>
          <tr>
              <th>Produto</th>
              <th style="text-align:center">Preço</th>
              <th style="text-align:center">Quantidade</th>
              <th style="text-align:center">Preço Total</th>
              <th style="text-align:center">Remover</th>
          </tr>
        </thead>
        <tbody>
          @if($itens_carrinho == null)
              <p>Carrinho Vazio</p>
          @else
          @foreach ($itens_carrinho as $key => $item)
            <tr>
                <td>{{$item->nome}}</td>
                <td style="text-align:center">R${{$item->preco}}</td>
                <td style="text-align:center">
                    <a href="#" class="mininuir-item" data-key-produto-atualizar="{{$key}}" style="color:white; margin-right: 10px;padding: 2px 10px 2px 10px; background-color:#424242 ; border-radius:5px">-</a>
                    <span id="quantidade-produto-{{$key}}">{{$item->quantidade}}</span>
                    <a href="#" class="add-item" data-key-produto-atualizar="{{$key}}" data-id-produto="{{$item->id_produto}}" style="color:white;margin-left: 10px; padding: 2px 10px 2px 10px; background-color:#424242 ; border-radius:5px">+</a>
                </td>
                <td style="text-align:center">
                    R$<span id="preco-total-produto-{{$key}}">{{$item->preco_total}}</span>
                </td>
                <td style="text-align:center;"><a href="#modal1" class="modal-trigger remove-item" data-nome-produto-remover="{{$item->nome}}"  data-id-produto-remover="{{$key}}"><i class="fas fa-trash" style="color:red"></i> </a></td>
            </tr>
          @endforeach
          @endif

        </tbody>
      </table>
      <br>
      <div class="row">
        <div class="col s12 grey lighten-2">
            <h5>Subtotal: <b id="sub-total-carrinho">R${{$pedido->valor_pedido}}</b></h5>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="cupom" type="text" class="validate">
          <label for="cupom">Cupom de Desconto</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12 grey lighten-2">
            <h5>Desconto: <b>R$0</b></h5>
        </div>
      </div>
      <div class="row light-blue grey lighten-4">
        <div class="col s12">
            <h5>Total: <b id="total-carrinho">R${{$pedido->valor_pedido}}</b></h5>
        </div>
      </div>

      <a class="waves-effect waves-light btn-large " style="width: 100%">Finalizar Pedido</a>
      <br><br>


    <!-- Modal Structure -->
        <div id="modal1" class="modal">
        <div class="modal-content">
        <h5 id="nome-produto-remover"></h5>
        </div>
        <div class="modal-footer">
            <a class="waves-effect waves-light btn" id="link-remover-produto">Remover</a>
            <a class="waves-effect waves-light btn modal-close">Cancelar</a>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('js/carrinho.js')}}"></script>
@endsection
