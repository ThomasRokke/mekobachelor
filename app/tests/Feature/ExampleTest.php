<?php

namespace Tests\Feature;
use App\Workshop;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginView()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }


    //Driver homepage /
    public function testDriverHome()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->get('/');

        $response->assertStatus(200);
        $response->assertSuccessful();
    }

    //get edit user both as authorized and unautorized
    public function testEditUserAuthorized ()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->get('/edituser?user_id=1');

        $response->assertStatus(200);
    }

    public function testEditUserUnauthorized ()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->get('/edituser?user_id=1');

        $response->assertStatus(401);
    }

    //post edit user both as autorized and unautorized,
    public function testPostEditUserUnauthorized ()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['_token' => 'test'])
            ->get('/edituser?user_id=1');

        $response->assertStatus(401);
    }

    public function testPostEditUserAuthorized ()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)
            ->withSession(['_token' => 'test'])
            ->get('/edituser?user_id=1');

        $response->assertStatus(200);
    }


    //Get create user as driver/admin
    public function testCreateUserUnauthorized ()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['_token' => 'test'])
            ->get('/createuser');

        $response->assertStatus(401);
    }

    public function testCreateUserAuthorized ()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)
            ->withSession(['_token' => 'test'])
            ->get('/createuser');

        $response->assertStatus(200);
    }


    //Test edit workshops
    public function testGetEditWorkshopUnauthorized ()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['_token' => 'test'])
            ->get('/workshop/edit?workshop_id=68');

        $response->assertStatus(401);
    }

    public function testGetEditWorkshopAuthorized ()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)
            ->withSession(['_token' => 'test'])
            ->get('/workshop/edit?workshop_id=68');

        $response->assertStatus(200);
    }

    //Test edit workshops
    public function testGetCreateWorkshopUnauthorized ()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['_token' => 'test'])
            ->get('/workshops/create');

        $response->assertStatus(401);
    }

    public function testGetCreateWorkshopAuthorized ()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)
            ->withSession(['_token' => 'test'])
            ->get('/workshops/create');

        $response->assertStatus(200);
    }

    //Test dashboard
    public function testGetDashboardUnauthorized ()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['_token' => 'test'])
            ->get('/dashboard');

        $response->assertStatus(401);
    }

    public function testGetDashboardAuthorized ()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)
            ->withSession(['_token' => 'test'])
            ->get('/dashboard');

        $response->assertStatus(200);
    }







}
