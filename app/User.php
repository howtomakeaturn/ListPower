<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

    function topics()
    {
        return $this->belongsToMany('App\Topic');
    }

    function entities()
    {
        return $this->hasMany('App\Entity');
    }

    function comments()
    {
        return $this->hasMany('App\Comment');
    }

    function reviews()
    {
        return $this->hasMany('App\Review');
    }

    function editings()
    {
        return $this->hasMany('App\Editing');
    }

    function photos()
    {
        return $this->hasMany('App\Photo');
    }

    function entityTags()
    {
        return $this->hasMany('App\EntityTag');
    }

    function isAdmin()
    {
        return in_array($this->email, config('general.super_admin'));
    }
}
