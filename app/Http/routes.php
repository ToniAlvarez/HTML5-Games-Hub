<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::auth();

Route::get('/', 'MainController@home');

Route::resource('usuarios', 'UsuarioController',
    ['except' => ['create', 'store']]);

Route::resource('juegos', 'JuegoController');

Route::resource('juegos.valoraciones', 'ValoracionController',
    ['only' => ['store', 'destroy']]);

//Ruta para los avatares
Route::get('/avatares/{avatar}', function ($avatar) {

    $file = storage_path() . "/avatares/$avatar";
    $exif = exif_imagetype($file);

    $mimeType = false;

    if ($exif === IMAGETYPE_JPEG)
        $mimeType = 'image/jpeg';
    elseif ($exif === IMAGETYPE_GIF)
        $mimeType = 'image/gif';
    else if ($exif === IMAGETYPE_PNG)
        $mimeType = 'image/png';

    if (!File::exists($file) or (!$mimeType)) {
        $avatar = File::get(storage_path() . "/avatares/avatar-default.png");
        $mimeType = 'image/png';
    } else {
        $avatar = File::get($file);
    }

    return Response::make($avatar, 200, array('Content-Type' => $mimeType));
});