<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        //Autenticación requerida para todos los métodos, excepto para listar y mostrar
        $this->middleware('auth', ['except' => ['show', 'index']]);
    }

    /**
     * Muesra un usuario a partir de su id
     *
     */
    protected function show($id)
    {
        //Recuperar el usuario a partir de su ID
        $usuario = User::find($id);

        //Comprobar que el usuario existe
        if ($usuario && $usuario->count()) {
            return view('usuario.show', ['usuario' => $usuario]);
        } else {
            return redirect('/usuarios');
        }
    }

    /**
     * Muestra el listado de usuarios
     *
     */
    protected function index()
    {
        return view('usuario.index', ['usuarios' => User::orderBy('created_at', 'asc')->paginate(20)]);
    }

    /**
     * Show user
     *
     */
    protected function edit($id)
    {
        $usuario = User::find($id);

        //Si el usuario no existe, redirigir a la lista de usuarios
        if (!$usuario)
            return redirect('/usuarios');

        //Comprobar que el usuario es administrador o quiere modificar su propio perfil, en caso contrario redireccionar a la vista de usuario
        if (Auth::user()->isAdmin || Auth::user()->id == $usuario->id)
            return view('usuario.edit', ['usuario' => $usuario]);
        else
            return redirect('/usuarios/' . $id);
    }

    /**
     * Actualizar un usuario a partir de su id
     *
     */
    public function update($id)
    {
        //Primero obtenemos el usuario a editar
        $usuario = User::find($id);

        //Si el usuario no existe, redirigir a la lista de usuarios
        if (!$usuario)
            return redirect('/usuarios');

        //Comprobar que el usuario actual es administrador o el mismo usuario que se está modificando
        if (Auth::user()->isAdmin || Auth::user()->id == $usuario->id) {

            $reglas = array(
                'email' => 'email|unique:users',     //El email tiene que ser único en la table users
            );

            $validator = Validator::make(Input::all(), $reglas);

            //Si falla la validación, volver a la página de edición y mostrar los errores
            if ($validator->fails())
                return redirect()->back()->withErrors($validator);

            //Comprobar si el usuario quiere cambiar la contraseña
            if (Input::has('password')) {

                //Regla de validacion para el campo contraseña
                //Sacado de StackOverflow: http://stackoverflow.com/a/31549892/710274
                $reglasPassword = array(
                    'old_password' => 'required|old_password:' . Auth::user()->password,
                    'password' => 'required|min:6',
                    'password_confirmation' => 'required|same:password'
                );

                $validatorPassword = Validator::make(Input::all(), $reglasPassword);

                //Si falla la validación, volver a la página de edición y mostrar los errores
                if ($validatorPassword->fails())
                    return redirect()->back()->withErrors($validatorPassword);

                //Validación correcta, cambiar la contraseña
                $usuario->password = Hash::make(Input::get('password'));
            }

            //Si no falla la validacion, obtenemos los campos del formulario
            if (Input::has('name'))
                $usuario->name = Input::get('name');

            if (Input::has('email'))
                $usuario->email = Input::get('email');

            $usuario->sobremi = Input::get('sobremi');
            $usuario->aficiones = Input::get('aficiones');
        }

        //Comprobar si se sube un nuevo avatar
        if (Request::HasFile('avatar')) {

            //Comprobar que el avatar actual del usuarios no es uno de los avatares por defecto y eliminarlo
            if (substr($usuario->avatar, 0, 6) !== "avatar") {
                $avatar_antiguo = $usuario->avatar;
                unlink(sprintf(storage_path() . "/avatares/" . $avatar_antiguo));
            }

            //Obtener la imagen subida, renombrarla para hacerla única y moverla
            $file = Request::file('avatar');

            $nombre_avatar = time() . '-' . $file->getClientOriginalName();

            $file->move(storage_path() . "/avatares/", $nombre_avatar);

            $usuario->avatar = $nombre_avatar; //Actualizar el avatar del usuario

        }

        //Guardar los cambios en la BD
        $usuario->save();

        Session::flash('msg', 'El perfil ha sido actualizado');

        return redirect('/usuarios/' . $id);
    }


    /**
     * Eliminar un usuario
     *
     */
    protected
    function destroy($id)
    {
        $usuario = User::find($id);

        //Si el usuario no existe, redirigir a la pagina anterior
        if (!$usuario)
            return redirect()->back();

        //Comprobar si el usuario actual es administrador
        if (Auth::user()->isAdmin) {
            //Obtener el usuario a eliminar y eliminarlo
            $usuario->delete();

            Session::flash('msg', 'El usuario ' . $usuario->name . ' ha sido eliminado');
        }

        //Redireccionar a la página anterior
        return redirect()->back();
    }
}
