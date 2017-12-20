<?php

namespace Tests\Feature\Http\Controllers\Security;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetLoginRoute()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function testPostLogin()
    {
        $user = factory(\App\Models\Security\User::class)->create();
        
        $response = $this->post('/login', ['usr_username' => $user->usr_username, 'usr_password' => 'secret']);

        $response->assertStatus(200);
    }
}
