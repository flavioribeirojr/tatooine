<?php

namespace Tests\Unit\Repositories\Security;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Security\Profile;
use App\Models\Security\User;
use App\Repositories\Security\ProfileRepository;
use App\Repositories\Security\UserRepository;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private $userRepository;

    public function setUp()
    {
        parent::setUp();

        $profileRepository = new ProfileRepository(new Profile());
        $this->userRepository = new UserRepository(new User(), $profileRepository);
    }

    public function testUserLogin()
    {
        $user = factory(\App\Models\Security\User::class)->create();

        $loggedIn = $this->userRepository->logUserIn(['usr_username' => $user->usr_username, 'usr_password' => 'secret']);

        $this->assertEquals(true, $loggedIn);
    }

    public function testDoNotLoginWrongUser()
    {
        $user = factory(\App\Models\Security\User::class)->make();
        
        $loggedIn = $this->userRepository->logUserIn(['usr_username' => $user->usr_username, 'usr_password' => 'secret']);

        $this->assertEquals(false, $loggedIn);
    }

    public function testGetUserPermissions()
    {
        $user = factory(\App\Models\Security\User::class)->create();
        $profile = factory(\App\Models\Security\Profile::class)->create();
        $permissions = factory(\App\Models\Security\Permission::class, 5)->create();

        $profile->permissions()->attach($permissions->pluck('prm_id'));
        $user->profiles()->attach($profile->prf_id);

        $userResources = $this->userRepository->getUserPermissions($user);
        
        $userPermissions = array_flatten($userResources['permissions']);
        $permissions = $permissions->pluck('prm_method')->toArray();

        $arrayEquals = array_diff($userPermissions, $permissions);

        $this->assertEquals(0, count($arrayEquals));
    }

    public function testSetNoneExistentProfileToUser()
    {
        $user = factory(\App\Models\Security\User::class)->create();

        $profileSetted = $this->userRepository->setUserProfile($user->usr_id, 1);

        $this->assertEquals(false, $profileSetted);
    }

    public function testSetNoneExistentUserToProfile()
    {
        $profile = factory(\App\Models\Security\Profile::class)->create();

        $profileSetted = $this->userRepository->setUserProfile(1, $profile->prf_id);

        $this->assertEquals(false, $profileSetted);
    }

    public function testSetExistentRelationBetweenUserAndProfile()
    {
        $user = factory(\App\Models\Security\User::class)->create();
        $profile = factory(\App\Models\Security\Profile::class)->create();

        $user->profiles()->attach($profile->prf_id);

        $userProfileUntouched = $this->userRepository->setUserProfile($user->usr_id, $profile->prf_id);

        $this->assertEquals(true, $userProfileUntouched);
    }

    public function testSetNewUserProfileRelation()
    {
        $user = factory(\App\Models\Security\User::class)->create();
        $profile = factory(\App\Models\Security\Profile::class)->create();

        $this->userRepository->setUserProfile($user->usr_id, $profile->prf_id);

        $profileUserSetted = $user->profiles()->where('prf_id', $profile->prf_id)->count();

        $this->assertEquals(1, $profileUserSetted);
    }

    public function testUnsetNoneExistentProfileToUser()
    {
        $user = factory(\App\Models\Security\User::class)->create();

        $profileUnsetted = $this->userRepository->unsetUserProfile($user->usr_id, 1);

        $this->assertEquals(false, $profileUnsetted);
    }

    public function testUnsetNoneExistentUserToProfile()
    {
        $profile = factory(\App\Models\Security\Profile::class)->create();

        $profileUnsetted = $this->userRepository->unsetUserProfile(1, $profile->prf_id);

        $this->assertEquals(false, $profileUnsetted);
    }

    public function testUnsetNoneExistentRelationBetweenUserAndProfile()
    {
        $user = factory(\App\Models\Security\User::class)->create();
        $profile = factory(\App\Models\Security\Profile::class)->create();

        $userProfileUntouched = $this->userRepository->unsetUserProfile($user->usr_id, $profile->prf_id);

        $this->assertEquals(true, $userProfileUntouched);
    }

    public function testUnsetNewUserProfileRelation()
    {
        $user = factory(\App\Models\Security\User::class)->create();
        $profile = factory(\App\Models\Security\Profile::class)->create();

        $user->profiles()->attach($profile->prf_id);

        $this->userRepository->unsetUserProfile($user->usr_id, $profile->prf_id);

        $profileUserUnsetted = $user->profiles()->where('prf_id', $profile->prf_id)->count();

        $this->assertEquals(0, $profileUserUnsetted);
    }
}