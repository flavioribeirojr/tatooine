<?php

use Illuminate\Database\Seeder;
use App\Models\Security\Resource;
use App\Models\Security\Permission;
use App\Models\Security\Profile;

class ResourcesPermissionsSeeder extends Seeder
{
    private $adminProfile;
    
    public function run()
    {
        $this->adminProfile = Profile::where('prf_name', 'master')->first();

        //USER RESOURCE
        $this->createNewResource('users', [
            'index', 'create', 'edit', 'delete', 'details'
        ]);
        
        //PROFILE RESOURCE
        $this->createNewResource('profiles', [
            'index', 'create', 'edit', 'delete', 'details'
        ]);
    }

    private function createNewResource(string $resourceName, array $permissions)
    {
        if (Resource::where('rsc_name', $resourceName)->count()) return;

        $resource = Resource::create([
            'rsc_name' => $resourceName
        ]);

        $methods = $this->formatPermissionsIntoMethods($permissions);

        $permissions = $resource->permissions()->createMany($methods);

        $this->adminProfile->permissions()->attach($permissions);
    }

    private function formatPermissionsIntoMethods(array $permissions)
    {
        $methods = [];

        array_walk($permissions, function ($permission) use (&$methods) {
            $methods[] = ['prm_method' => $permission];
        });

        return $methods;
    }
}