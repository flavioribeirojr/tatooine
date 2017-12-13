<?php

namespace App\Models\Security;

use Core\Model;

class Resource extends Model
{
    protected $primaryKey = 'rsc_id';
    
    protected $fillable = ['rsc_name', 'rsc_description', 'rsc_rct_id'];

    public function permissions()
    {
        return $this->hasMany('App\Models\Security\Permission', 'prm_rsc_id', 'rsc_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Security\ResourceCategory', 'rsc_rct_id', 'rct_id');
    }
}
