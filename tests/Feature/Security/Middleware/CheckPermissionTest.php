<?php

namespace Tests\Feature\Security\Middleware;

use Tests\TestCase;

class CheckPermissionTest extends TestCase
{
    public function testAllowAccessToAuthorizedUser()
    {

        $this->post('/login', ['usr_email' => 'admin@system.com', 'usr_password' => '123456']);
        
        $response = $this->get('/users');

        $response->assertStatus(200);
    }
}
