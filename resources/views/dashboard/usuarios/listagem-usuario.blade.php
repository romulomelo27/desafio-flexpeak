@extends('dashboard.blank')

@section('atalho')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page">Usuários</li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{url('usuarios')}}">Listagem de Usuários</a></li>
  </ol>
</nav>
@endsection

@section('conteudo')
<!-- Page content -->
<div class="card">
    <div class="card-body">
        <b>Lista de Usuários</b>
        <hr>
        <div class="btn-group">
            <a href="{{url('/usuarios/novoUsuario')}}" class="btn btn-primary">Novo</a>
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Impressão</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-secondary table-hover table-sm" id="dataTable">
                <thead>
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </th>
                </thead>
                <tfoot>
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
                </tfoot>
                <tbody>
                @php
                $cont = 0;
                $inicio = (($page * 10)+1)-10;
                $cont = $inicio;
                @endphp
                @foreach($usuarios as $usuario)
                <tr>
                    <td class="text-center" style="color: black">{{$cont++}}</td>
                    <td style="color: black">{{$usuario->name}}</td>
                    <td style="color: black">{{$usuario->email}}</td>
                    <td style="color: black">
                        <a href="{{url("usuarios/edicaoUsuario/".$usuario->id)}}" title="Editar"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <br>
            {{ $usuarios->links() }}
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#dataTable').DataTable({
                "bPaginate": false, //hide pagination
                "bFilter": true, //hide Search bar
                "bInfo": false, // hide showing entries
            });
        } );
    </script>
@endsection
