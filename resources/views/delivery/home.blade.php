@extends('delivery.blank')

@section('conteudo')

  <br><br><br>
  <nav>
    <div class="nav-wrapper grey darken-3">
      <form>
        <div class="input-field">
          <input id="search" type="search" required placeholder="Pesquisar Produtos">
          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
          <i class="material-icons">close</i>
        </div>
      </form>
    </div>
  </nav>
  <br>

  <div class="row">
    @foreach ($produtos as $produto)
    <div class="col s12 m3">
      <div class="card">
        <div class="card-image">
          <img src="{{url('storage/'.$produto->imagem1) }}" alt="Imagem Produto">
          <a class="btn-floating halfway-fab waves-effect waves-light red add-item" data-id-produto="{{$produto->id}}">
            <i class="material-icons">add</i>
          </a>
        </div>
        <div class="card-content grey lighten-3">
          <span class="card-title" style="font-size: 20px">{{$produto->nome}}</span>
          <p><b>R${{$produto->preco}}</b></p>
        </div>
      </div>
    </div>
    @endforeach
  </div>





  <br>
  @if($paginas > 1)

  <ul class="pagination">
    @for ($i = 1; $i <= $paginas; $i++)
    <li class="{{$i == $pagina_atual ? 'active':'waves-effect'}}"><a href="{{'?page='.$i}}">{{$i}}</a></li>
    @endfor
  </ul>
  @endif
  <br>
@endsection

@section('scripts')
    <script src="{{asset('js/carrinho.js')}}"></script>
@endsection
