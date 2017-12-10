<?php

namespace Tests\Feature\Http\Controllers\Security\Async;

use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    public function testGetUserPermissions()
    {
        $this->post('/login', ['usr_email' => 'admin@system.com', 'usr_password' => '123456']);
        
        $response = $this->get(baseUrl() . '/users/permissions');

        $response->assertStatus(200);
    }
}