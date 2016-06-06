<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Valoracion;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ValoracionController extends Controller
{
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        //Autenticación requerida para todos los métodos
        $this->middleware('auth');
    }

    /**
     * Crear una valoracion
     *
     */
    protected function store()
    {

        $valoracion = new Valoracion;
        $valoracion->puntuacion = Input::get('puntuacion');
        $valoracion->comentario = Input::get('comentario');
        $valoracion->user_id = Input::get('user_id');
        $valoracion->juego_id = Input::get('juego_id');

        $valoracion->save();

        Session::flash('msg', '¡Gracias por enviarnos tu valoración!');

        //Volver a la página anterior
        return redirect()->back();
    }

    /**
     * Eliminar una valoracion
     *
     */
    protected function destroy($url_juego, $id_valoracion)
    {
        $valoracion = Valoracion::whereRaw('id = ' . $id_valoracion)->first();

        //Si la valoracion no existe, redirigir a la pagina anterior
        if (!$valoracion)
            return redirect('/');

        //Comprobar si el usuario actual es administrador
        if (Auth::user()->isAdmin) {
            //Obtener el usuario a eliminar y eliminarlo
            $valoracion->delete();

            Session::flash('msg', 'La valoración ha sido eliminada');

        }

        //Redireccionar a la página anterior
        return redirect()->back();
    }
}
