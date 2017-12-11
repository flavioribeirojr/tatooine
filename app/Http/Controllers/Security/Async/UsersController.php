<?php

namespace App\Http\Controllers\Security\Async;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Security\UserRepository;

class UsersController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function getUserPermissions()
    {
        $user = \Auth::user();
        
        $userPermissions = $this->userRepository->getUserPermissions($user);
        
        return response(['permissions' => $userPermissions], 200);
    }

    public function getUsers(Request $request)
    {
        $data = $this->userRepository->listModel($request->all());

        return response($data, 200);
    }
}