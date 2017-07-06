<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    const DEFAULT_IMAGE = '/images/noimage.jpg';


    public function posts ()
    {
        return $this->hasMany('App\Post');
    }

    public function comments ()
    {
        return $this->hasMany('App\Comment');
    }

    public function getAvatarAttribute ($value)
    {
        return $value ?: asset(self::DEFAULT_IMAGE);
    }
}
