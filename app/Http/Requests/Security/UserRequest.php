<?php

namespace App\Http\Requests\Security;

use Core\Request;
use Illuminate\Validation\Rule;

class UserRequest extends Request
{
    public function rules()
    {
        $rules = [
            'usr_name'            => 'required|max:60',
            'usr_email'           => 'required|email',
            'usr_enabled'         => 'required|boolean',
            'usr_password'        => 'required',
            'usr_password_repeat' => 'required|same:usr_password',
            'usr_username'        => [
                'required',
                Rule::unique('users')->ignore($this->get('usr_id'), 'usr_id')
            ]
        ];

        if ($this->method() == 'PUT') {
            unset($rules['usr_password'], $rules['usr_password_repeat']);
        }

        return $rules;
    }
}