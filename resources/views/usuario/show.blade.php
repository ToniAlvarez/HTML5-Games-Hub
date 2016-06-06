@extends('base.base')

@section('title', 'Gamehub - Editar perfil')

@section('content')
    <div class="container">
        <div class="row">


            @if (Session::has('msg'))
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-success mt-100">{{ Session::get('msg') }}</div>
                </div>
            @endif

            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary mt-20">
                    <div class="panel-heading">Ver perfil de usuario</div>
                    <div class="panel-body">
                        <div class="col-xs-12 col-sm-4 text-center">
                            <img src="{{ url('/avatares/' .  $usuario->avatar) }}" class="center-block img-responsive">
                            <h2>{{ $usuario->name }}</h2>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                            <p><strong>Sobre mi: </strong> {{ $usuario->sobremi }}</p>
                            <p><strong>Aficiones: </strong> {{ $usuario->aficiones }} </p>
                        </div>

                        @if(!Auth::guest() && (Auth::user()->isAdmin || Auth::user()->id == $usuario->id))
                            <div class="col-xs-12 text-center">
                                <a class="btn btn-primary" href="{{ url('/usuarios/' .  $usuario->id . '/edit') }}">
                                    <i class="fa fa-btn fa-pencil"></i>
                                    Editar perfil
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
