<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getIsAdminAttribute()
    {
        return $this->tipo === 'Administrador';
    }

    public function getIsDevAttribute()
    {
        return $this->tipo === 'Desarrollador';
    }

    public function getIsUserAttribute()
    {
        return $this->tipo === 'Usuario';
    }

    /**
     * Devuelve los juegos del desarrollador
     */
    public function juegos()
    {
        return $this->hasMany('App\Models\Juego');
    }
    /**
     * Devuelve los comentarios de un usuario
     */
    public function valoracions()
    {
        return $this->hasMany('App\Models\Valoracion');
    }
}
