<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nombre', 'descripcion', 'imagen', 'activo', 'dev_id'
    ];

    /**
     * Funcion que devuelve el juego al que pertenece la valoracion
     */
    public function juego()
    {
        return $this->belongsTo('App\Models\Juego');
    }

    /**
     * Funcion que devuelve el usuario al que pertenece la valoracion
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
