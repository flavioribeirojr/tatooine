<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use App\Http\Requests\Security\LoginRequest;
use App\Repositories\Security\UserRepository;

class LoginController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(LoginRequest $request)
    {
        $validatedUser = $this->userRepository->logUserIn($request->all());

        if ($validatedUser) {
            return response(['success' => 'User logged'], 200);
        }

        return response(['error' => 'Error in log user in'], 403);
    }

    public function logout()
    {
        \Auth::logout();
        
        return redirect('/login');
    }
}
