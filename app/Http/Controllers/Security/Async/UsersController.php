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
        
        return response($userPermissions, 200);
    }

    public function getUsers(Request $request)
    {
        $data = $this->userRepository->listModel($request->all());

        return response($data, 200);
    }

    public function setUserProfile(Request $request)
    {
        $user = $request->get('user');
        $profile = $request->get('profile');

        $profileSet = $this->userRepository->setUserProfile($user, $profile);

        if ($profileSet) {
            return response(['message' => 'User profile successfully setted'], 200);
        }

        return response(['error' => 'User profile not setted'], 500);
    }

    public function unsetUserProfile(Request $request)
    {
        $user = $request->get('user');
        $profile = $request->get('profile');

        $profileUnset = $this->userRepository->unsetUserProfile($user, $profile);

        if ($profileUnset) {
            return response(['message' => 'User profile successfully unsetted'], 200);
        }

        return response(['error' => 'User profile not unsetted'], 500);   
    }
}