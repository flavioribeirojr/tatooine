<?php

namespace App\Repositories\Security;

use Core\Repository;
use App\Models\Security\Profile;

class ProfileRepository extends Repository
{
    public function __construct(Profile $model)
    {
        $this->model = $model;
    }

    public function setProfilePermissions($profileId, array $permissions)
    {
        $profile = $this->find($profileId);

        if (!$profile) {
            return false;
        }
        
        $profile->permissions()->sync($permissions);

        return true;
    }
}