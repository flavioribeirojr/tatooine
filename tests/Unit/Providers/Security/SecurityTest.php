<?php

namespace Tests\Unit\Providers\Security;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Security\Profile;
use App\Models\Security\Permission;
use App\Repositories\Security\ProfileRepository;

class SecurityTest extends TestCase
{
    use RefreshDatabase;

    private $security;

    public function setUp()
    {
        parent::setUp();
        
        $this->security = \App::make(\App\Providers\Security\Security::class);
    }

    public function testMustAllowUserAccess()
    {
        $user = factory(\App\Models\Security\User::class)->create();
        $profile = factory(\App\Models\Security\Profile::class)->create();
        $permissions = factory(\App\Models\Security\Permission::class, 5)->create();

        $profile->permissions()->attach($permissions->pluck('prm_id')->toArray());
        $user->profiles()->attach($profile->prf_id);

        $route = '/' . $permissions->first()->resource->rsc_name . '/' . $permissions->first()->prm_method;
        
        $shouldAllow = $this->security->checkUserPermission($user, config('app.base_route') . $route);

        $this->assertEquals(true, $shouldAllow);
    }

    public function testMustNotAllowAccess()
    {
        $user = factory(\App\Models\Security\User::class)->create();
        $profile = factory(\App\Models\Security\Profile::class)->create();
        $permissions = factory(\App\Models\Security\Permission::class, 5)->create();

        $profile->permissions()->attach($permissions->pluck('prm_id')->toArray());
        $user->profiles()->attach($profile->prf_id);

        $profile->permissions()->detach($permissions->last()->prm_id);

        $route = '/' . $permissions->last()->resource->rsc_name . '/' . $permissions->last()->prm_method;
        
        $shouldNotAllow = $this->security->checkUserPermission($user, config('app.base_route') . $route);

        $this->assertEquals(false, $shouldNotAllow);
    }
}