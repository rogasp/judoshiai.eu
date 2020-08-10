<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function check_if_user_is_admin_or_not_admin()
    {
        factory(User::class)
            ->create([
                'admin_since' => null,
            ]);

        $user = User::find(1);
        $this->assertNotTrue($user->isAdmin());

        $user->admin_since = now();
        $user->save();
        $this->assertTrue($user->isAdmin());
    }
}
