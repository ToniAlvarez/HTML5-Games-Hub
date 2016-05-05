<?php

namespace App;

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
        return $this->tipo === 'admin';
    }

    public function getIsDevAttribute()
    {
        return $this->tipo === 'dev';
    }

    public function getIsUserAttribute()
    {
        return $this->tipo === 'user';
    }

}
