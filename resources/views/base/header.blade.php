<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Gamehub
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li class="{{ (Request::is('juegos*') ? 'active' : '') }}">
                    <a href="{{ url('/juegos') }}">Juegos</a>
                </li>
                <li class="{{ (Request::is('usuarios') ? 'active' : '') }}">
                    <a href="{{ url('/usuarios') }}">Usuarios</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <b>Iniciar sesión</b> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu login-dropdown">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form" role="form" method="post" action="{{ url('/login') }}"
                                              accept-charset="UTF-8">

                                            {!! csrf_field() !!}

                                            <div class="form-group">
                                                <label class="sr-only">Email</label>
                                                <input type="email" class="form-control" name="email"
                                                       placeholder="Email" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only">Contraseña</label>
                                                <input type="password" class="form-control" name="password"
                                                       placeholder="Contraseña" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">
                                                    Iniciar sesión
                                                </button>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> Recúerdame
                                                </label>
                                            </div>
                                        </form>
                                        <hr/>
                                        <div class="help-block text-center"><a
                                                    href="{{ url('/password/reset') }}">
                                                ¿Has olvidado tu contraseña?</a>
                                        </div>
                                        <hr/>
                                        <div class="bottom text-center">
                                            <label>¿No tienes cuenta?</label>
                                            <a class="btn btn-primary btn-block" href="{{ url('/register') }}">
                                                <b>Regístrate</b>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="dropdown {{ (Request::is('usuarios/' . Auth::user()->id) ? 'active' : '') }}">
                        <a href="#" class="dropdown-toggle user-dropdown" data-toggle="dropdown" role="button"
                           aria-expanded="false">

                            <img src="{{ url('/avatares/' .  Auth::user()->avatar) }}" class="navbar-avatar hidden-xs">
                            {{ Auth::user()->name }}
                            <b class="caret"></b>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/usuarios/' .  Auth::user()->id) }}">
                                    <i class="fa fa-btn fa-user"></i>
                                    Mi perfil
                                </a>
                                <a href="{{ url('/logout') }}">
                                    <i class="fa fa-btn fa-sign-out"></i>
                                    Salir
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
