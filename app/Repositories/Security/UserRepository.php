<?php

namespace App\Repositories\Security;

use Core\Repository;
use App\Models\Security\User;
use App\Repositories\Security\ProfileRepository;

class UserRepository extends Repository
{
    protected $profileRepository;

    public function __construct(
        User $model, 
        ProfileRepository $profileRepository
    ) {
        $this->model = $model;
        $this->profileRepository = $profileRepository;
    }

    public function create(array $data)
    {
        $user = $this->fill($data);

        $user->usr_password = bcrypt($data['usr_password']);
        $user->save();
    }

    public function logUserIn(array $data)
    {
        $user = $this->where('usr_username', $data['usr_username'])->first();

        if (!$user) {
            return false;
        }

        if (password_verify($data['usr_password'], $user->usr_password)) {
            \Auth::login($user);

            return true;
        }

        return false;
    }

    public function getUserPermissions(User $user)
    {
        $permissions = $user->profiles->load('permissions')->pluck('permissions')->unique('prm_method')->collapse();

        $userPermisions = [];
        $userMenu = [];
        
        $permissions->groupBy('prm_rsc_id')->map(function ($permissionByResource) use (&$userPermisions, &$userMenu) {
            $resource = $permissionByResource->first()->resource;
            $category = $resource->category;

            $userPermisions[$resource->rsc_name] = $permissionByResource->pluck('prm_method')->toArray();
            
            $userMenu[$category->rct_name][] = [
                $resource->rsc_name => $resource->rsc_description
            ];
        });

        return ['permissions' => $userPermisions, 'menu' => $userMenu];
    }

    public function setUserProfile($userId, $profileId)
    {
        $user = $this->find($userId);
        $profile = $this->profileRepository->find($profileId);

        if (!$user || !$profile) {
            return false;
        }

        if ($user->profiles->where('prf_id', $profileId)->count()) {
            return true;
        }

        $user->profiles()->attach($profileId);

        return true;
    }

    public function unsetUserProfile($userId, $profileId)
    {
        $user = $this->find($userId);
        $profile = $this->profileRepository->find($profileId);

        if (!$user || !$profile) {
            return false;
        }

        if (!$user->profiles->where('prf_id', $profileId)->count()) {
            return true;
        }

        $user->profiles()->detach($profileId);

        return true;
    }
}