<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Juego extends Model
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
     * Funcion que devuelve el desarrollador al que pertenece el juego
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Devuelve las valoraciones de un juego
     */
    public function valoracions()
    {
        return $this->hasMany('App\Models\Valoracion')->orderBy('created_at', 'desc');;
    }
}
