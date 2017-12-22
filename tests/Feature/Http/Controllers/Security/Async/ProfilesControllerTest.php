<?php

namespace Tests\Feature\Http\Controllers\Security\Async;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfilesControllerTest extends TestCase
{
    use RefreshDatabase;

    private $profile;

    public function setUp()
    {
        parent::setUp();

        \Auth::login(factory(\App\Models\Security\User::class)->create());
        $this->profile = $profile = factory(\App\Models\Security\Profile::class)->create();
    }

    public function testGetProfiles()
    {   
        $response = $this->get(baseUrl('/profiles/list'));

        $response->assertStatus(200);
    }

    public function testSetProfilePermissions()
    {
        $permissionOne = factory(\App\Models\Security\Permission::class)->create();
        $permissionTwo = factory(\App\Models\Security\Permission::class)->create();

        $permissions = [$permissionOne->prm_id, $permissionTwo->prm_id];

        $response = $this->post(baseUrl('/profiles/setpermissions/' . $this->profile->prf_id), ['permissions' => $permissions]);

        $permissionsProfileCount = $this->profile->permissions->count();

        $this->assertEquals(2, $permissionsProfileCount);
    }

    public function testUnsetProfilePermissions()
    {
        $permissionOne = factory(\App\Models\Security\Permission::class)->create();
        $permissionTwo = factory(\App\Models\Security\Permission::class)->create();

        $this->profile->permissions()->attach([$permissionOne, $permissionTwo]);

        $permissions = [$permissionOne->prm_id];

        $response = $this->post(baseUrl('/profiles/setpermissions/' . $this->profile->prf_id), ['permissions' => $permissions]);

        $permissionsProfileCount = $this->profile->permissions->count();

        $this->assertEquals(1, $permissionsProfileCount);
    }

    public function testSetNonexistentPermission()
    {
        $response = $this->post(baseUrl('/profiles/setpermissions/' . $this->profile->prf_id), ['permissions' => [1, 2]]);

        $countProfilePermissions = $this->profile->permissions->count();

        $this->assertEquals(0, $countProfilePermissions);
    }
}