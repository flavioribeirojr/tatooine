<?php

use Illuminate\Database\Seeder;
use App\Models\Security\Resource;
use App\Models\Security\Permission;
use App\Models\Security\Profile;
use App\Models\Security\ResourceCategory;

class ResourcesPermissionsSeeder extends Seeder
{
    private $adminProfile;
    
    public function run()
    {
        $this->adminProfile = Profile::where('prf_name', 'master')->first();

        $securityCategory = $this->getResourceCategory('security', 'Security');

        //USER RESOURCE
        $this->createNewResource(['users' => 'Gerenciamento de usuários'], [
            'index'   => 'Listagem de usuários', 
            'create'  => 'Cadastrar usuário', 
            'edit'    => 'Editar usuário', 
            'delete'  => 'Excluir usuário', 
            'details' => 'Gerenciar perfis do usuário'
        ], $securityCategory);
        
        //PROFILE RESOURCE
        $this->createNewResource(['profiles' => 'Gerenciamento de perfis'], [
            'index'   => 'Listagem de perfis', 
            'create'  => 'Cadastrar perfil', 
            'edit'    => 'Editar perfil', 
            'delete'  => 'Excluir perfil',
            'details' => 'Gerenciamento de permissões'
        ], $securityCategory);

    }

    private function getResourceCategory($slug, $name)
    {
        $category = ResourceCategory::where('rct_slug', $slug)->first();

        if (!$category) {
            $category = ResourceCategory::create(['rct_slug' => $slug, 'rct_name' => $name]);
        }

        $category->rct_name = $name;
        $category->save();

        return $category;
    }

    /**
     * Creates a new resource with 
     * @method createNewResource
     */
    private function createNewResource(array $resource, array $permissions, $category)
    {
        list($resourceName, $resourceDescription) = array_divide($resource);
        
        $resource = Resource::where('rsc_name', head($resourceName))->first();

        if (!$resource) {
            $resource = Resource::create([
                'rsc_name'        => head($resourceName),
                'rsc_description' => head($resourceDescription),
                'rsc_rct_id'      => $category->rct_id
            ]);
        }

        $resource->rsc_description = head($resourceDescription);
        $resource->rsc_rct_id = $category->rct_id;
        $resource->save();
        
        $methods = $this->formatPermissionsIntoMethods($permissions, $resource->rsc_id);

        $resourcePermissions = $resource->permissions()->createMany($methods);

        $this->cleanPermissions($permissions, $resource->permissions);

        $this->adminProfile->permissions()->attach($resourcePermissions);
    }

    private function formatPermissionsIntoMethods(array $permissions, $rscId)
    {
        $methods = [];
        
        array_walk($permissions, function ($description, $slug) use (&$methods, $rscId) {
            $permission = Permission::where('prm_method', $slug)->where('prm_rsc_id', $rscId)->first();

            if (!$permission) {
                $methods[] = [
                    'prm_method'      => $slug,
                    'prm_description' => $description
                ];

                return;
            }

            $permission->prm_description = $description;
            $permission->save();
        });
        
        return $methods;
    }

    private function cleanPermissions(array $permissions, $persistedPermissions)
    {
        $methods = array_keys($permissions);
        
        $trashPermissions = $persistedPermissions->whereNotIn('prm_method', $methods)->pluck('prm_id')->toArray();

        Permission::whereIn('prm_id', $trashPermissions)->delete();
    }
}