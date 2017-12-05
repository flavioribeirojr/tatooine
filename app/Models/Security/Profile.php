<?php

namespace App\Models\Security;

use Core\Model;

class Profile extends Model
{
    protected $primaryKey = 'prf_id';

    protected $fillable = ['prf_name'];

    public function users()
    {
        return $this->belongsToMany('App\Models\Security\User', 'users_profiles', 'usp_prf_id', 'usr_id');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Security\Permissions', 'profile_permissions', 'pfp_prf_id', 'pfp_prm_id');
    }
}
