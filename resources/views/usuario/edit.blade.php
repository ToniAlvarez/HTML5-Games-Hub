@extends('base.base')

@section('title', 'Gamehub - Editar perfil')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                @if (Session::has('msg'))
                    <div class="alert alert-success mt-120">{{ Session::get('msg') }}</div>
                @endif

                <div class="panel panel-primary mt-20">
                    <div class="panel-heading">Editar perfil de usuario</div>
                    <div class="panel-body">
                        {!! Form::model($usuario, array('method'=>'Patch','route' => array('usuarios.update', $usuario->id), 'class' => 'form-horizontal','files' => true)) !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-5 control-label">Nombre</label>

                            <div class="col-md-5">
                                <input type="text" class="form-control" name="name" placeholder="{{ $usuario->name }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-5 control-label">Email</label>

                            <div class="col-md-5">
                                <input type="email" class="form-control" name="email" placeholder="{{ $usuario->email }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sobremi') ? ' has-error' : '' }}">
                            <label class="col-md-5 control-label">Sobre mi</label>

                            <div class="col-md-5">

                                <textarea class="form-control" rows="5"
                                          name="sobremi">{{ $usuario->sobremi }}</textarea>

                                @if ($errors->has('sobremi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sobremi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('aficiones') ? ' has-error' : '' }}">
                            <label class="col-md-5 control-label">Aficiones</label>

                            <div class="col-md-5">
                                <input type="text" class="form-control" name="aficiones"
                                       value="{{ $usuario->aficiones }}">

                                @if ($errors->has('aficiones'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('aficiones') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                            <label class="col-md-5 control-label">Cambiar avatar</label>

                            <div class="col-md-5">
                                <label class="control-label">Subir archivo</label>
                                <input name="avatar" type="file" class="file">

                                <img class="img-responsive avatar-100 mt-20 mb-10"
                                     src="{{ url('/avatares/' .  $usuario->avatar) }}">


                                @if ($errors->has('avatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr/>

                        <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                            <label class="col-md-5 control-label">Contraseña actual</label>

                            <div class="col-md-5">
                                <input type="password" class="form-control" name="old_password" placeholder="*******">

                                @if ($errors->has('old_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-5 control-label">Nueva contraseña</label>

                            <div class="col-md-5">
                                <input type="password" class="form-control" name="password" placeholder="*******">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-5 control-label">Confirmar nueva contraseña</label>

                            <div class="col-md-5">
                                <input type="password" class="form-control" name="password_confirmation"
                                       placeholder="*******">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-floppy-o"></i> Modificar perfil
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
