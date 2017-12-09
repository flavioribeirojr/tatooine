<?php

namespace App\Providers\Security;

use App\Models\Security\Resource;

class Security
{
    public function checkUserPermission($user, $action)
    {
        $actions = $this->splitAction($action);
        
        $hasPermission = false;
        
        $resource = Resource::where('rsc_name', $actions['resource'])->first();
        
        if (!$resource) {
            return false;
        }
        
        $permission = $actions['permission'];
        
        $userHasPermission = $user->profiles()->whereHas('permissions', function ($query) use ($permission) {
            $query->where('prm_method', $permission);
        })->count();
        
        return $userHasPermission;
    }

    private function splitAction($actionUrl)
    {
        $url = explode('/', $actionUrl);
        
        return [
            'resource'   => $url[1], 
            'permission' => empty($url[2]) ? 'index' : $url[2]
        ];
    }
}