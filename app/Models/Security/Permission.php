<?php

namespace App\Models\Security;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $primaryKey = 'prm_id';
    
    protected $fillable = [
        'prm_method',
        'prm_description', 
        'prm_rsc_id'
    ];

    public function resource()
    {
        return $this->belongsTo('App\Models\Security\Resource', 'prm_rsc_id', 'rsc_id');
    }

    public function profiles()
    {
        return $this->belongsToMany('App\Models\Security\Profile', 'profiles_permissions', 'pfp_prm_id', 'pfp_prf_id');
    }
}
