<?php

namespace App\Models\Security;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'usr_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usr_username', 
        'usr_email', 
        'usr_password',
        'usr_name',
        'usr_enabled',
        'usr_remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'usr_password'
    ];

    public function profiles()
    {
        return $this->belongsToMany('App\Models\Security\Profile', 'users_profiles', 'usp_usr_id', 'usp_prf_id');
    }

    public function getAuthPassword()
    {
        return $this->usr_password;
    }

    public function getRememberTokenAttribute($value)
    {
        return $this->usr_remember_token;
    }
}
