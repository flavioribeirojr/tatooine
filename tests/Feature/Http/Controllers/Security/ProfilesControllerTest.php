<?php

namespace Tests\Feature\Http\Controllers\Security;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Models\Security\Profile;

class ProfilesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        \Auth::login(factory(\App\Models\Security\User::class)->create());
    }

    public function testIndex()
    {
        $response = $this->get(baseUrl('/profiles'));

        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $response = $this->get(baseUrl('/profiles/create'));

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $profile = factory(\App\Models\Security\Profile::class)->make()->toArray();

        $response = $this->post(baseUrl('/profiles/store'), $profile);
        $profileCreated = Profile::where('prf_name', $profile['prf_name'])->get()->count();

        $response->assertStatus(302);
        $this->assertEquals(1, $profileCreated);
    }

    public function testEdit()
    {
        $profile = factory(\App\Models\Security\Profile::class)->create();

        $response = $this->get(baseUrl('/profiles/edit/' . $profile->prf_id));

        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $profile = factory(\App\Models\Security\Profile::class)->create();
        $data = factory(\App\Models\Security\Profile::class)->make()->toArray();

        $response = $this->put(baseUrl('/profiles/update/' . $profile->prf_id), $data);
        $profileUpdated = Profile::find($profile->prf_id);

        $response->assertStatus(302);
        $this->assertEquals($data['prf_name'], $profileUpdated->prf_name);
    }

    public function testDelete()
    {
        $profile = factory(\App\Models\Security\Profile::class)->create();

        $response = $this->delete(baseUrl('/profiles/delete/' . $profile->prf_id));

        $profileDeleted = Profile::find($profile->prf_id);

        $response->assertStatus(200);
        $this->assertEquals(null, $profileDeleted);
    }

    public function getDetails()
    {
        $profile = factory(\App\Models\Security\Profile::class)->create();

        $response = $this->get(baseUrl('/profiles/details/' . $profile->prf_id));

        $response->assertStatus(200);
    }
}