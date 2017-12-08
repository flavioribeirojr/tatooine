<?php

namespace Tests\Feature\Security\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{

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
        $response = $this->post('/login', ['usr_email' => 'admin@system.com', 'usr_password' => '123456']);

        $response->assertStatus(200);
    }

    public function testPostLogout()
    {
        $this->post('/login', ['usr_email' => 'admin@system.com', 'usr_password' => '123456']);

        $response = $this->post('/logout');
        
        $this->assertEquals(null, \Auth::user());
    }
}
