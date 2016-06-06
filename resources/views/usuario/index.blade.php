@extends('base.base')

@section('content')
    <div class="container">
        <div class="row">

            @if (Session::has('msg'))
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-success mt-20">{{ Session::get('msg') }}</div>
                </div>
            @endif

            <div class="col-md-12">
                <div class="panel panel-primary mt-20 mb-50">
                    <div class="panel-heading">Listado de usuarios</div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table user-list">
                                <thead>
                                <tr>
                                    <th><span>Usuario</span></th>
                                    <th><span>Tipo</span></th>
                                    <th><span>Fecha de alta</span></th>
                                    @if(!Auth::guest() && Auth::user()->isAdmin)
                                        <th><span>Email</span></th>
                                        <th><span>Acciones</span></th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($usuarios as $usuario)
                                    <tr>
                                        <td>
                                            <a class="user-link" href="usuarios/{{$usuario->id}}">
                                                <img class="avatar-list mr-20" src="avatares/{{$usuario->avatar}}">
                                                {{$usuario->name}}
                                            </a>
                                        </td>
                                        @if ($usuario->tipo == 'Administrador')
                                            <td>
                                                <span class="label label-danger user-type">{{$usuario->tipo}}</span>
                                            </td>
                                        @elseif ($usuario->tipo == 'Desarrollador')
                                            <td>
                                                <span class="label label-success user-type">{{$usuario->tipo}}</span>
                                            </td>
                                        @else
                                            <td>
                                                <span class="label label-default user-type">{{$usuario->tipo}}</span>
                                            </td>
                                        @endif
                                        <td>{{$usuario->created_at->format('d/m/Y')}}</td>
                                        @if(!Auth::guest() && Auth::user()->isAdmin)
                                            <td><a href="mailto:{{$usuario->email}}">{{$usuario->email}}</a></td>
                                            <td>

                                                <a href="/usuarios/{{$usuario->id}}/edit"
                                                   class="table-link success">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a>

                                                @if(!$usuario->isAdmin)
                                                    <a href="#" class="table-link danger"
                                                       data-toggle="modal" data-target="#del-{{$usuario->id}}">
                                                        <span class="fa-stack">
                                                            <i class="fa fa-square fa-stack-2x"></i>
                                                            <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                    </a>

                                                    <div id="del-{{$usuario->id}}" class="modal fade">

                                                        <div class="modal-dialog">

                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal">&times;</button>
                                                                    <h4>Eliminar usuario</h4>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <p>Estás a punto de eliminar al usuario
                                                                        <i>{{$usuario->name}}</i>.</p>
                                                                    <p>¿Quieres continuar?</p>

                                                                    {{ Form::open(array('route' => array('usuarios.destroy', $usuario->id), 'method' => 'delete')) }}
                                                                    <button type="submit" class="btn btn-danger">
                                                                        <i class="fa fa-btn fa-trash-o"></i> Confirmar
                                                                    </button>
                                                                    {{ Form::close() }}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <script>

                $(document).ready(function () {
                    $('.table-link.danger').on('click', function (e) {
                        e.preventDefault();

                        var id = $(this).data('id');
                        $('#modal-confirmacion-' + id).modal('show');
                    });
                });

            </script>


            <div class="row mt-15 mb-70">
                <div class="col-sm-12 text-center">
                    {!! $usuarios->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
