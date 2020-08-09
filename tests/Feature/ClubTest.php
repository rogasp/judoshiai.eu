<?php

namespace Tests\Feature;

use App\User;
use App\Club;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClubTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function Example()
    {
        factory(User::class)->create();

        $users = User::all();

        $this->assertCount(1,$users);

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function check_if_user_is_admin()
    {
        factory(User::class)->create();

        $user = User::find(1);

        $user->admin_since = now();
        $user->save();

        $this->assertTrue($user->isAdmin());

        $user->admin_since = null;
        $user->save();

        $this->assertNotTrue($user->isAdmin());

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
