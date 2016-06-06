@extends('base.base')

@section('title', 'Gamehub - Editar juego')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                @if (Session::has('msg'))
                    <div class="alert alert-success mt-120">{{ Session::get('msg') }}</div>
                @endif

                <div class="panel panel-primary mt-20">
                    <div class="panel-heading">Editando el juego {{ $juego->nombre }}</div>
                    <div class="panel-body">
                        {!! Form::model($juego, array('method'=>'Patch','route' => array('juegos.update', $juego->id), 'class' => 'form-horizontal','files' => true)) !!}

                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label class="col-md-5 control-label">Nombre</label>

                            <div class="col-md-5">
                                <input type="text" class="form-control" name="nombre" value="{{ $juego->nombre }}">

                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!--
                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label class="col-md-5 control-label">Url amigable</label>

                            <div class="col-md-5">
                                <input type="text" class="form-control" name="url" placeholder="{{ $juego->url }}">

                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        -->

                        <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                            <label class="col-md-5 control-label">Descripción</label>

                            <div class="col-md-5">
                                <textarea class="form-control" rows="5"
                                          name="descripcion">{{ $juego->descripcion }}</textarea>

                                @if ($errors->has('descripcion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('imagen') ? ' has-error' : '' }}">
                            <label class="col-md-5 control-label">Cambiar imagen</label>

                            <div class="col-md-5">
                                <label class="control-label">Subir archivo</label>
                                <input name="imagen" type="file" class="file">

                                <img class="img-responsive avatar-100 mt-20 mb-10"
                                     src="{{ url('/gamedata/' .  $juego->url) . '/' .$juego->imagen }}">


                                @if ($errors->has('imagen'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('imagen') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-floppy-o"></i> Actualizar juego
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
