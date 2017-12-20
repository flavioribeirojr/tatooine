<?php

namespace App\Repositories\Security;

use Core\Repository;
use App\Models\Security\Permission;

class PermissionRepository extends Repository
{
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }
}