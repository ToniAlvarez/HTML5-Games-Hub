@extends('base.base')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($juegos as $juego)
                <div class="col-sm-6 col-md-3 mb-60 sm-text-center">
                    <div class="panel panel-primary mt-50 mb-50">
                        <div class="panel-heading">{{$juego->nombre}}</div>
                        <div class="panel-body">

                            <a href="juegos/{{ $juego->url }}">
                                <div class="center-cropped text-center">
                                    <img class="avatar-150"
                                         src="{{ url('/gamedata') . '/' . $juego->url . '/' . $juego->imagen }}"
                                         alt="">
                                </div>
                            </a>
                            <div class="content border-1px p-15 bg-white-light">
                                <h6 class="title mt-0">Publicado por: {{$juego->user->name}} el
                                    <i>{{$juego->created_at->format('d/m/Y')}}</i></h6>
                                <p class="mb-30">{{$juego->descripcion}}</p>

                                <div class="text-center">
                                    <a class="btn btn-primary" href="juegos/{{ $juego->url }}">
                                        <i class="fa fa-btn fa-play"></i>
                                        Jugar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="row mt-15 mb-70">
                <div class="col-sm-12 text-center">
                    {!! $juegos->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
