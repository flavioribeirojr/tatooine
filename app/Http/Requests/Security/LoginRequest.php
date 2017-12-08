<?php

namespace App\Http\Requests\Security;

use Core\Request;

class LoginRequest extends Request
{
    public function rules()
    {
        return [
            'usr_email'    => 'required|email',
            'usr_password' => 'required'
        ];
    }
}