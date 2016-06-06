<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Juego;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class JuegoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Autenticación requerida para todos los métodos, excepto para listar y mostrar
        $this->middleware('auth', ['except' => ['show', 'index']]);
    }

    /**
     * Muestra un juego a partir de su id
     *
     */
    protected function show($url)
    {

        $juego = Juego::where('url', 'LIKE', $url)->first();


        //Si el juego no existe volver a la lista de juegos.
        if (!$juego)
            return redirect('/juegos');


        $juegoValorado = false;

        //Comprobar si el usuario actual ha valorado este juego
        if (!Auth::guest()) {
            foreach ($juego->valoracions as $valoracion) {
                if ($valoracion->user_id == Auth::user()->id) {
                    $juegoValorado = true;
                    break;
                }
            }
        }

        //Calcular la valoración media del juego
        $totalValoraciones = 0;

        foreach ($juego->valoracions as $valoracion) {
            $totalValoraciones += $valoracion->puntuacion;
        }

        $valoracionMedia = $totalValoraciones / count($juego->valoracions);

        return view('juego.show', ['juego' => $juego, 'usuarioHaValorado' => $juegoValorado, 'valoracionMedia' => $valoracionMedia])->render();;
    }

    /**
     * Muestra el listado de juegos
     *
     */
    protected function index()
    {
        return view('juego.index', ['juegos' => Juego::orderBy('created_at', 'asc')->paginate(12)]);
    }

    /**
     * Editar un juego
     *
     */
    protected function edit($url)
    {

        $juego = Juego::where('url', 'LIKE', $url)->first();

        if (!$juego)
            return redirect('/juegos');

        //TODO Comprobar que el usuario es administrador, o es un desarrollador que quiere modificar su propio juego
        //En caso contrario redireccionar a la vista del juego
        if (Auth::user()->isAdmin || Auth::user()->id == $juego->id)
            return view('juego.edit', ['juego' => $juego]);
        else
            return redirect('/juegos/' . $url);
    }

    /**
     * Actualizar un juego a partir de su id
     *
     */
    public function update($id)
    {
        //Primero obtenemos el usuario a editar
        $juego = Juego::find($id);

        if (!$juego)
            return redirect('/juegos');

        //Comprobar que el usuario actual es administrador o el desarrollador del juego que se está modificando
        if (Auth::user()->isAdmin || Auth::user()->id == $juego->user_id) {

            //Obtenemos los campos del formulario
            if (Input::has('nombre'))
                $juego->nombre = Input::get('nombre');

            $juego->descripcion = Input::get('descripcion');

            //Comprobar si se sube una nueva imagen
            if (Request::HasFile('imagen')) {

                //Obtener el archivo subido
                $file = Request::file('imagen');

                //Moverlo a la carpeta de juegos
                $file->move(public_path() . "/game-images/" . $juego->url, $file->getClientOriginalName());

                $juego->imagen = $file->getClientOriginalName();

            }

            //Guardar los cambios en la BD
            $juego->save();
        }

        return redirect('/juegos/' . $juego->url);
    }


    /**
     * Eliminar un usuario
     *
     */
    protected function destroy($id)
    {

        $juego = Juego::find($id);

        if (!$juego)
            return redirect()->back();

        //Comprobar si el usuario actual es administrador
        if (Auth::user()->isAdmin) {
            //Obtener el juego a eliminar y eliminarlo
            $juego->delete();
        }

        //Redireccionar a la página anterior
        return redirect()->back();
    }
}
