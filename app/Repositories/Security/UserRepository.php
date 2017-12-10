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
        
        return $permissions->groupBy('prm_rsc_id')->map(function ($permissionByResource) {
            $resource = $permissionByResource->first()->resource->rsc_name;
            
            return [$resource => $permissionByResource->pluck('prm_method')->toArray()];
        })->collapse()->toArray();
    }
}