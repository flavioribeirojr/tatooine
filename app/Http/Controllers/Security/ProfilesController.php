<?php

namespace App\Http\Controllers\Security;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Security\ProfileRequest;
use App\Repositories\Security\ProfileRepository;

class ProfilesController extends Controller
{
    protected $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function index()
    {
        return view('profiles.index');
    }

    public function create()
    {
        return view('profiles.create');
    }

    public function store(ProfileRequest $request)
    {
        try {
            $data = $request->all();

            $profileCreated = $this->profileRepository->create($data);

            return redirect(baseUrl('/profiles'))->with('message', 'Pefil cadastrado com sucesso');
        } catch (\Exception $e) {
            if (config('app.debug')) {
                throw $e;
            }

            return redirect()->back()->withErrors(['exception' => config('custom.exception')]);
        }
    }

    public function edit($profileId)
    {
        $profile = $this->profileRepository->find($profileId);
        
        if (!$profile) {
            return redirect()->back()->withErrors(['error' => 'Perfil não existe']);
        }

        return view('profiles.edit', compact('profile'));
    }

    public function update($profileId, ProfileRequest $request)
    {
        try {
            $profile = $this->profileRepository->find($profileId);
            
            if (!$profile) {
                return redirect()->back()->withInput()->withErrors(['error' => 'Usuário não existe']);
            }

            $data = $request->only($this->profileRepository->getFillable());
            
            $this->profileRepository->update($profile->prf_id, $data);

            return redirect(baseUrl('/profiles'))->with('message', 'Perfil atualizado com sucesso');
        } catch (\Exception $e) {
            if (config('app.debug')) {
                throw $e;
            }

            return redirect()->back()->withErrors(['exception' => config('custom.exception')]);
        }
    }

    public function delete($profileId)
    {
        try {
            $profile = $this->profileRepository->find($profileId);
            
            if (!$profile) {
                return redirect()->back()->withInput()->withErrors(['error' => 'Perfil não existe']);
            }
    
            $profile->delete();
    
            return response(['message' => 'Perfil excluído com sucesso'], 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                throw $e;
            }

            return response(['exception' => config('custom.exception')], 500);
        }
    }
}
