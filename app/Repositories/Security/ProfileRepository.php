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
}