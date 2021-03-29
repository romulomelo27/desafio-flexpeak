<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="{{asset('/css/materialize.min.css')}}"  media="screen,projection"/>
      <link href="{{asset('css/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Delivery</title>
      <style>
          body {
                display: flex;
                min-height: 100vh;
                flex-direction: column;
            }

            main {
                flex: 1 0 auto;
            }

      </style>
    </head>

    <body>
        <header >
            <div class="navbar-fixed">
                <nav class="nav-extended grey darken-4">
                    <div class="nav-wrapper" style="border-bottom: 1px solid #424242    ">
                    <a href="{{url('/')}}" class="brand-logo" id="url">
                        Logo
                        {{-- <img src="{{url('storage/'.$empresa->logo) }}" width="200px" alt="Logo"> --}}
                    </a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        @foreach ($categorias as $categ)
                        <li><a href="#">{{$categ->nome}}</a></li>
                        @endforeach
                    </ul>
                    </div>
                    <div class="nav-content" style="float: right;">
                        <ul class="tabs tabs-transparent">
                            <li style="margin-top:15px"><a href="{{url('/carrinho')}}" title="Ver Carrinho">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="15" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg><span style="font-size: 15px" id="valorCarrinho">(R$ {{$pedido->valor_pedido}})</span></a>
                            </li>
                            <li style="margin-top:15px">
                                @auth
                                    <a href="#">OLÁ, <b>{{Auth::user()->name}}</b></a>
                                @else
                                    <a href="#">Entrar</a>
                                @endauth
                            </li>
                        </ul>
                    </div>

                </nav>
            </div>
            <ul class="sidenav" id="mobile-demo">
                <li style="background-color:#E6E6E6; text-align:center"><b>Menu</b></li>

                @foreach ($categorias as $categ)
                <li><a href="#">{{$categ->nome}}</a></li>
                @endforeach
            </ul>
        </header>
        <main>
            <div class="container">
                @yield('conteudo')
            </div>
        </main>
        <footer class="page-footer  grey darken-4">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Footer Content</h5>
                <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
              </div>
              <div class="col l4 s12">
                <h5 class="white-text">Categorias</h5>
                <ul>
                  @foreach ($categorias as $categ)
                    <li><a class="grey-text text-lighten-3" href="#!">{{$categ->nome}}</a></li>
                  @endforeach
                </ul>
              </div>
              <div class="col l2 s12">
                <h5 class="white-text">Páginas</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Entrar</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Novo Cadastro</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Carrinho</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Minha Conta</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2014 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
          </div>
        </footer>


      <!--JavaScript at end of body for optimized loading-->
      <script src="{{asset('/js/materialize.js')}}"></script>
      <script src="{{asset('js/jquery.min.js')}}"></script>
      <script type="text/javascript">
        M.AutoInit();
        $(document).ready(function(){
            $('.sidenav').sidenav();
            $('.carousel').carousel();
        });

      </script>
       @yield('scripts')
    </body>
  </html>
