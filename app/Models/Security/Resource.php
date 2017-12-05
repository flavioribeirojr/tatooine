<?php

namespace App\Models\Security;

use Core\Model;

class Resource extends Model
{
    protected $primaryKey = 'rsc_id';
    
    protected $fillable = ['rsc_name'];

    public function permissions()
    {
        return $this->hasMany('App\Models\Security\Permission', 'prm_rsc_id', 'rsc_id');
    }
}
