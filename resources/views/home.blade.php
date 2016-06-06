@extends('base.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary mt-150">
                    <div class="panel-heading">Bienvenido a Gamehub</div>

                    <div class="panel-body text-center">

                        @if (Auth::guest())

                            <p class="mt-40 mb-30">Bienvenido <i>invitado</i>. Para disfrutar del 100% de las
                                carácterísticas la página es
                                necesario registrarse.</p>


                            <a href="{{ url('/login') }}" class="btn btn-primary">¡Iniciar sesión!</a>
                            <a href="{{ url('/register') }}" class="btn btn-primary">¡Ir al registro!</a>

                        @else

                            <div class="text-center">
                                <img class="avatar-150 mt-20"
                                     src="{{ url('/avatares/' .  Auth::user()->avatar) }}">
                            </div>

                            <h4 class="mt-40 mb-30">Bievenido de nuevo <i>{{  Auth::user()->name }}</i></h4>


                            <a href="{{ url('/usuarios/' .  Auth::user()->id) }}" class="btn btn-primary">Ver mi
                                perfil</a>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
