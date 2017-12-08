<?php

namespace App\Providers\Security;

use App\Models\Security\Resource;

class Security
{
    public function checkUserPermission($user, $resource, $permission)
    {
        $hasPermission = false;

        $resource = Resource::where('rsc_name', $resource)->first();
        
        if (!$resource) {
            return false;
        }

        $permissions = $resource->permissions->pluck('prm_id')->toArray();
        
        $userHasPermission = $user->profiles()->whereHas('permissions', function ($query) use ($permissions) {
            $query->whereIn('prm_id', $permissions);
        })->count();

        return $userHasPermission;
    }

    private function checkPermissionForResource($user, $permissions)
    {

    }
}