<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Si la pagina requiere autenticación para entrar
        //$this->middleware('auth');
    }


    /**
     * Mostrar la página principal.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Mostrar el listado de juegos
     *
     * @return \Illuminate\Http\Response
     */
    public function juegos()
    {
        return view('home');
    }

    /**
     * Editar perfil de usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function editarPerfil()
    {
        return view('user.edit');
    }
}
