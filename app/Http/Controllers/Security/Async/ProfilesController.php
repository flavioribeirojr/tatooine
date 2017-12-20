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

    public function setProfilePermissions($prfId, Request $request)
    {
        try {
            $data = $request->get('permissions');
            
            $permissionsSetted = $this->profileRepository->setProfilePermissions($prfId, $data);
    
            if ($permissionsSetted) {
                return response(['message' => 'Permissions successfully setted'], 200);
            }
    
            return response(['error' => 'Permissions not setted'], 500);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                throw $e;
            }

            return response(['exception' => config('custom.exception')], 500);
        }
    }
}