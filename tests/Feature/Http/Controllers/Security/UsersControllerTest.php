<?php

namespace Tests\Feature\Http\Controllers\Security;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Models\Security\User;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp()
    {
        parent::setUp();
        \Auth::login(factory(\App\Models\Security\User::class)->create());
    }

    public function testIndex()
    {
        $response = $this->get(baseUrl('/users'));

        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $response = $this->get(baseUrl('/users/create'));
        
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $data = factory(\App\Models\Security\User::class)
            ->make([
                'usr_password_repeat' => '123456'
            ])
            ->toArray();

        $data['usr_password'] = '123456';
        
        $response = $this->post(baseUrl('/users/store'), $data);
        $userInDatabase = User::where('usr_username', $data['usr_username'])->count();
        
        $response->assertStatus(302);
        $this->assertEquals(1, $userInDatabase);
    }

    public function testEdit()
    {
        $user = factory(\App\Models\Security\User::class)->create();

        $response = $this->get(baseUrl('/users/edit/' . $user->usr_id));

        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $user = factory(\App\Models\Security\User::class)->create();

        $data = factory(\App\Models\Security\User::class)->make()->toArray();
        
        $response = $this->put(baseUrl('/users/update/' . $user->usr_id), $data);

        $user = User::find($user->usr_id);

        $response->assertStatus(302);
        $this->assertEquals(true, $user->usr_username == $data['usr_username']);
    }

    public function testDelete()
    {
        $user = factory(\App\Models\Security\User::class)->create();

        $response = $this->delete(baseUrl('/users/delete/' . $user->usr_id));

        $userDeleted = User::find($user->usr_id);

        $response->assertStatus(200);
        $this->assertEquals(null, $userDeleted);
    }

    public function testDetails()
    {
        $user = factory(\App\Models\Security\User::class)->create();
        
        $response = $this->get(baseUrl('/users/details/' . $user->usr_id));

        $response->assertStatus(200);
    }
}