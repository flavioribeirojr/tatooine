<?php

namespace Tests\Unit\Repositories\Security;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Security\Profile;
use App\Models\Security\Permission;
use App\Repositories\Security\ProfileRepository;

class ProfileRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private $profileRepository;

    public function setUp()
    {
        parent::setUp();

        $this->profileRepository = new ProfileRepository(new Profile());
    }

    public function testSetPermissionsToNonExistentProfile()
    {
        $permissions = factory(\App\Models\Security\Permission::class, 5)->create()->pluck('prm_id')->toArray();

        $profilePermissions = $this->profileRepository->setProfilePermissions(1, $permissions);

        $this->assertEquals(false, $profilePermissions);
    }

    public function testSetEmptyPermissionsArrayToProfile()
    {
        $profile = factory(\App\Models\Security\Profile::class)->create();
        
        $profilePermissions = $this->profileRepository->setProfilePermissions($profile->prf_id, []);

        $this->assertEquals(true, $profilePermissions);   
    }

    public function testSetProfilesPermissions()
    {
        $profile = factory(\App\Models\Security\Profile::class)->create();
        $permissions = factory(\App\Models\Security\Permission::class, 5)->create()->pluck('prm_id')->toArray();
        
        $this->profileRepository->setProfilePermissions($profile->prf_id, $permissions);

        $profilePermissions = $profile->permissions->count();

        $this->assertEquals(5, $profilePermissions);
    }

    public function testUnsetProfilePermissions()
    {
        $profile = factory(\App\Models\Security\Profile::class)->create();
        $permissions = factory(\App\Models\Security\Permission::class, 5)->create()->pluck('prm_id')->toArray();

        $profile->permissions()->attach($permissions);
        
        $this->profileRepository->setProfilePermissions($profile->prf_id, []);

        $profilePermissions = $profile->permissions->count();

        $this->assertEquals(0, $profilePermissions);
    }
}