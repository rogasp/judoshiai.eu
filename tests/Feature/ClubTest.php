<?php

namespace Tests\Feature;

use App\Club;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClubTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function get_country_name_for_club()
    {
        factory(Club::class)
            ->create([
                'country_code' => 'se',
            ]);

        $club = Club::find(1);
        $this->assertEquals('Sweden', $club->country_name());
    }

    /**
     * @test
     */
    public function is_club_activated()
    {
        factory(Club::class)
            ->create([
                'activated_at' => null,
            ]);

        $club = Club::find(1);
        $this->assertNotTrue($club->is_activated());

        $club->activated_at = now();
        $club->save();

        $this->assertTrue($club->is_activated());


    }

    /**
     * @test
     */
    public function is_club_approved()
    {
        factory(Club::class)
            ->create([
                'approved_at' => null,
            ]);

        $club = Club::find(1);
        $this->assertNotTrue($club->is_approved());

        $club->approved_at = now();
        $club->save();

        $this->assertTrue($club->is_approved());

    }

    /**
     * @test
     */
    public function check_if_authenticated_user_is_owner()
    {
        factory(Club::class)
            ->create([
                'approved_at' => null,
            ]);

        $club = Club::find(1);

        $user = User::find(2);
        $this->actingAs($user);

        $this->assertTrue($club->is_owner());

    }
}
