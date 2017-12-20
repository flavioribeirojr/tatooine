<?php

namespace Tests\Feature\Http\Controllers\Security\Async;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(\App\Models\Security\User::class)->create();
        \Auth::login($this->user);
    }

    public function testGetUserPermissions()
    {   
        $response = $this->get(baseUrl() . '/users/permissions');

        $response->assertStatus(200);
    }

    public function testGetUsers()
    {
        $response = $this->get(baseUrl() . '/users/list');

        $response->assertStatus(200);
    }

    public function testSetUserProfile()
    {
        $profile = factory(\App\Models\Security\Profile::class)->create();

        $response = $this->post(baseUrl('/users/setprofile'), ['user' => $this->user->usr_id, 'profile' => $profile->prf_id]);
        
        $userHasProfile = $this->user->profiles->where('prf_id', $profile->prf_id)->count();
        
        $response->assertStatus(200);
        $this->assertEquals(1, $userHasProfile);
    }

    public function testunsetUserProfile()
    {
        $profile = factory(\App\Models\Security\Profile::class)->create();

        $this->user->profiles()->attach($profile->prf_id);

        $response = $this->post(baseUrl('/users/unsetprofile'), ['user' => $this->user->usr_id, 'profile' => $profile->prf_id]);

        $userDoesntHaveProfile = $this->user->profiles->where('prf_id', $profile->prf_id)->count();

        $response->assertStatus(200);
        $this->assertEquals(0, $userDoesntHaveProfile);
    }
}