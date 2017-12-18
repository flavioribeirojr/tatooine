<?php

namespace App\Http\Requests\Security;

use Core\Request;

class ProfileRequest extends Request
{
    public function rules()
    {
        return [
            'prf_name'        => 'required|max:60',
            'prf_description' => 'required|max:100'
        ];
    }
}