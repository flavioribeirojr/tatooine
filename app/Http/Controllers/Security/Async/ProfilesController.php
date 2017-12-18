<?php

namespace App\Http\Controllers\Security\Async;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Security\ProfileRepository;

class ProfilesController extends Controller
{
    protected $profileRepository;
    
    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function getProfiles(Request $request)
    {
        $data = $this->profileRepository->listModel($request->all());
        
        return response($data, 200);
    }
}