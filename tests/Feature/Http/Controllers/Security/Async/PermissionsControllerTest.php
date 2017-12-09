<?php

namespace Tests\Feature\Http\Controllers\Security\Async;

use Tests\TestCase;

class PermissionsControllerTest extends TestCase
{
    public function testHasPermission()
    {
        $response = $this->post('/login', ['usr_email' => 'admin@system.com', 'usr_password' => '123456']);
        
        $action = baseUrl() . '/users/create';
        
        $response = $this->json('GET', baseUrl() . '/permissions/checkpermission', ['action' => $action]);

        $response->assertStatus(200)
            ->assertJson([
                'allow' => 1
            ]);
    }
}