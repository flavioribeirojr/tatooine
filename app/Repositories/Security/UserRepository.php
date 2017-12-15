<?php

namespace App\Repositories\Security;

use Core\Repository;
use App\Models\Security\User;

class UserRepository extends Repository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function logUserIn(array $data)
    {
        $user = $this->where('usr_email', $data['usr_email'])->first();

        if (!$user) {
            return false;
        }

        if (password_verify($data['usr_password'], $user->usr_password)) {
            \Auth::login($user);

            return true;
        }

        return false;
    }

    public function getUserPermissions(User $user)
    {
        $permissions = $user->profiles->load('permissions')->pluck('permissions')->unique('prm_method')->collapse();

        $userPermisions = [];
        $userMenu = [];
        
        $permissions->groupBy('prm_rsc_id')->map(function ($permissionByResource) use (&$userPermisions, &$userMenu) {
            $resource = $permissionByResource->first()->resource;
            $category = $resource->category;

            $userPermisions[$resource->rsc_name] = $permissionByResource->pluck('prm_method')->toArray();
            
            $userMenu[$category->rct_name][] = [
                $resource->rsc_name => $resource->rsc_description
            ];
        });

        return ['permissions' => $userPermisions, 'menu' => $userMenu];
    }
}