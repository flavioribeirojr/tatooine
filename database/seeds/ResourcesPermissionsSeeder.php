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
        $this->createNewResource(['users' => 'Gerenciamento de usuários'], [
            'index'   => 'Listagem de usuários', 
            'create'  => 'Cadastrar usuário', 
            'edit'    => 'Editar usuário', 
            'delete'  => 'Excluir usuário', 
            'details' => 'Gerenciar perfis do usuário'
        ]);
        
        //PROFILE RESOURCE
        $this->createNewResource(['profiles' => 'Gerenciamento de perfis'], [
            'index'   => 'Listagem de perfis', 
            'create'  => 'Cadastrar perfil', 
            'edit'    => 'Editar perfil', 
            'delete'  => 'Excluir perfil', 
            'details' => 'Gerenciar permissões do perfil'
        ]);

        $this->createNewResource(['permissions' => 'Gerenciamento de permissões'], [
            'checkpermission' => 'Verificação de permissão de acordo com rota'
        ]);
    }

    /**
     * Creates a new resource with 
     * @method createNewResource
     */
    private function createNewResource(array $resource, array $permissions)
    {
        list($resourceName, $resourceDescription) = array_divide($resource);
        
        $resource = Resource::where('rsc_name', head($resourceName))->first();

        if (!$resource) {
            $resource = Resource::create([
                'rsc_name'        => head($resourceName),
                'rsc_description' => head($resourceDescription)
            ]);
        }
        
        $methods = $this->formatPermissionsIntoMethods($permissions);

        $permissions = $resource->permissions()->createMany($methods);

        $this->adminProfile->permissions()->attach($permissions);
    }

    private function formatPermissionsIntoMethods(array $permissions)
    {
        $methods = [];
        
        array_walk($permissions, function ($description, $slug) use (&$methods) {

            if (!Permission::where('prm_method', $slug)->count()) {
                $methods[] = [
                    'prm_method'      => $slug,
                    'prm_description' => $description
                ];
            }
        });
        
        return $methods;
    }
}