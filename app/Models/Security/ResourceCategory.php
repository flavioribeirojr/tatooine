<?php

namespace App\Models\Security;

use Core\Model;

class ResourceCategory extends Model
{
    protected $primaryKey = 'rct_id';
    
    protected $fillable = ['rct_slug', 'rct_name'];

    protected $table = 'resources_categories';

    public function resources()
    {
        return $this->hasMany('App\Models\Security\Resource', 'rsc_rct_id', 'rct_id');
    }
}
