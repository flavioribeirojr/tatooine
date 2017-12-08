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
}