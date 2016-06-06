@extends('base.base')

@section('title', 'Gamehub - ' . $juego->nombre)

@section('game-assets')

    <!-- Game CSS -->
    <link href="{{ url('/') }}/gamedata/{{$juego->url}}/main.css" rel="stylesheet" type="text/css">

    <!-- Game main JS -->
    <script src="{{ url('/') }}/gamedata/{{$juego->url}}/main.js"></script>


    <!-- Star rating system CSS -->
    <link href="{{ url('/') }}/css/star-rating.css" rel="stylesheet" type="text/css">

    <!-- Star rating system JS -->
    <script src="{{ url('/') }}/js/star-rating.min.js"></script>

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row p-20" id="game-container">

                    <!-- El juego tiene que buscar el ID de este DIV y ejecutarse en él-->

                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary mt-50">
                    <div class="panel-heading">Datos del juego</div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="row mb-20">
                                    <div class="col-md-3">
                                        <p><strong>Desarrollador: </strong> {{ $juego->user->name }}</p>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <h2 class="m-0 p-0">{{ $juego->nombre }}</h2>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <p>
                                            <strong>En Gamehub
                                                desde: </strong> {{ $juego->created_at->format('d/m/Y') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-xs-12 text-center mb-20">
                                        <input id="valoracion-media" value="{{$valoracionMedia}}">
                                    </div>

                                    <script>

                                        $(document).ready(function () {
                                            $('#valoracion-media').rating({
                                                min: 0,
                                                max: 5,
                                                step: 1,
                                                size: 'sm',
                                                displayOnly: true
                                            });
                                        });

                                    </script>

                                    <div class="col-xs-12 text-center mt-20 mb-40">
                                        {{$juego->descripcion}}
                                    </div>
                                </div>
                            </div>

                            @if(!Auth::guest() && (Auth::user()->isAdmin || Auth::user()->id == $juego->user->id))
                                <div class="col-xs-12 text-center">
                                    <a class="btn btn-primary"
                                       href="{{ url('/juegos/' .  $juego->url) . '/edit/'}}">
                                        <i class="fa fa-btn fa-pencil"></i>
                                        Editar juego
                                    </a>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">

                @if (Session::has('msg'))
                    <div class="alert alert-success mt-20">{{ Session::get('msg') }}</div>
                @endif

                <div class="panel panel-primary mt-30">
                    <div class="panel-heading">Valoraciones</div>
                    <div class="panel-body">

                        @if(Auth::guest())
                            <div class="col-xs-12 text-center pt-20 pb-40">
                                <h4>Regístrate para poder valorar este juego</h4>
                            </div>

                        @elseif(!$usuarioHaValorado)

                            <div class="col-sm-1 text-right">
                                <div class="thumbnail">
                                    <img class="avatar-40"
                                         src="{{ url('/avatares/' .  Auth::user()->avatar) }}">
                                </div>
                            </div>

                            <div class="col-sm-11">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Enviar valoración
                                    </div>
                                    <div class="panel-body">

                                        <div class="col-sm-12">

                                            {{ Form::open(array('route' => array('juegos.valoraciones.store', $juego->url), 'method' => 'store')) }}


                                            <div class="form-group text-center">
                                                <input id="puntuacion-stars">

                                                <input type="hidden" name="puntuacion" id="puntuacion">
                                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                <input type="hidden" name="juego_id" value="{{$juego->id}}">

                                                <i id="caption" class="hidden"></i>
                                            </div>

                                            <div id="formulario-valoracion">

                                                <div class="form-group">
                                                    <label for="comentario" class="control-label">Comentario</label>

                                                    <textarea class="form-control" name="comentario" required
                                                              rows="5"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12 text-center">
                                                        <button class="btn btn-success btn-circle text-uppercase"
                                                                type="submit"
                                                                id="submitComment"><span
                                                                    class="glyphicon glyphicon-send"></span> Enviar
                                                            valoración
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>

                                $(document).ready(function () {

                                    $('#formulario-valoracion').hide();

                                    //Iniciar el plugin de estrellas
                                    var estrellas = $('#puntuacion-stars');

                                    estrellas.rating({
                                        min: 0,
                                        max: 5,
                                        step: 1,
                                        size: 'md',
                                        clearButton: '',
                                        clearCaption: '',
                                        language: 'es',
                                        captionElement: "#caption"
                                    });

                                    //Evento al cambiar las estrellas
                                    estrellas.on('rating.change', function (event, value, caption) {
                                        console.log(value);
                                        $('#puntuacion').val(value);

                                        $('#formulario-valoracion').show(250);
                                    });

                                });

                            </script>
                        @endif

                        @foreach($juego->valoracions as $valoracion)

                            <div class="col-sm-1 text-right">
                                <div class="thumbnail">
                                    <img class="avatar-40"
                                         src="{{ url('/avatares/' .  $valoracion->user->avatar) }}">
                                </div>
                            </div>

                            <div class="col-sm-11">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <strong>{{ $valoracion->user->name }}</strong>
                                            </div>
                                            <div class="col-xs-6 text-center">
                                                <input id="estrellas-{{$valoracion->user->id}}"
                                                       value="{{$valoracion->puntuacion}}">
                                            </div>
                                            <script>

                                                $(document).ready(function () {
                                                    $('#estrellas-{{$valoracion->user->id}}').rating({
                                                        min: 0,
                                                        max: 5,
                                                        step: 1,
                                                        size: 'xs',
                                                        displayOnly: true
                                                    });
                                                });

                                            </script>
                                            <div class="col-xs-3 text-right">
                                                <span class="text-muted">{{ $valoracion->created_at }}</span>

                                                @if(!Auth::guest() && Auth::user()->isAdmin)
                                                    <a href="#" class="table-link danger ml-20"
                                                       data-toggle="modal" data-target="#del-{{$valoracion->id}}">
                                                        <span class="fa-stack">
                                                            <i class="fa fa-square fa-stack-2x"></i>
                                                            <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                    </a>

                                                    <div id="del-{{$valoracion->id}}" class="modal fade">

                                                        <div class="modal-dialog">

                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal">&times;</button>
                                                                    <h4>Eliminar valoración</h4>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <p>Estás a punto de eliminar una valoración</p>
                                                                    <p>¿Quieres continuar?</p>

                                                                    {{ Form::open(array('route' => array('juegos.valoraciones.destroy', $juego->url, $valoracion->id), 'method' => 'delete')) }}
                                                                    <button type="submit" class="btn btn-danger">
                                                                        <i class="fa fa-btn fa-trash-o"></i> Confirmar
                                                                    </button>
                                                                    {{ Form::close() }}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        {{ $valoracion->comentario }}
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
