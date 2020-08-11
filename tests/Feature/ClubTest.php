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
            ->create();

        $club = Club::find(1);

        $user = User::find(2);
        $this->actingAs($user);

        $this->assertTrue($club->is_owner());

    }

    /**
     * @test
     */
    public function check_if_authenticated_user_is_admin()
    {
        factory(Club::class)
            ->create();

        $club = Club::find(1);

        $user = factory(User::class)
            ->create();

        $club->administrators()->attach($user->id);

        $this->actingAs($user);

        $this->assertTrue($club->is_admin());
    }

    /**
     * @test
     */
    public function do_i_get_clubs_im_involved_with_as_owner()
    {
        $user = factory(User::class)
            ->create();

        $club = factory(Club::class)
            ->create([
                'owner_id' => $user->id,
            ]);

        $this->actingAs($user);

        $clubs = Club::involved()->get();

        $this->assertEquals($club->id,$clubs->first()->id);
    }

    /**
     * @test
     */
    public function do_i_get_clubs_im_involved_with_as_administrator()
    {
        $user = factory(User::class)
            ->create();

        $club = factory(Club::class)
            ->create();

        $this->actingAs($user);

        $club->administrators()->attach($user->id);

        $clubs = Club::involved()->get();

        $this->assertEquals($club->id,$clubs->first()->id);
    }

    /**
     * @test
     */
    public function do_i_get_clubs_im_involved_with_as_owner_and_administrator_to_different_clubs()
    {
        $user = factory(User::class)
            ->create();

        $club1 = factory(Club::class)
            ->create();

        $club2 = factory(Club::class)
            ->create([
                'owner_id' => $user->id
            ]);

        $this->actingAs($user);

        $club1->administrators()->attach($user->id);

        $clubs = Club::involved()->get();

        $this->assertEquals(2, $clubs->count());

    }

    /**
     * @test
     */
    public function do_i_get_clubs_im_involved_with_as_owner_and_administrator_to_same_club()
    {
        $user = factory(User::class)
            ->create();

        $club1 = factory(Club::class)
            ->create();

        $club2 = factory(Club::class)
            ->create([
                'owner_id' => $user->id
            ]);

        $this->actingAs($user);

        $club2->administrators()->attach($user->id);

        $clubs = Club::involved()->get();

        $this->assertEquals(1, $clubs->count());
        $this->assertEquals($club2->id, $clubs->first()->id);
    }

    /**
     * @test
     */
    public function should_not_get_clubs_when_not_involved_as_owner_or_administrator()
    {
        $user = factory(User::class)
            ->create();

        $club1 = factory(Club::class)
            ->create();

        $club2 = factory(Club::class)
            ->create();

        $club2->administrators()->attach($user->id);

        $user = factory(User::class)
            ->create();

        $this->actingAs($user);

        $clubs = Club::involved()->get();

        $this->assertEquals(0, $clubs->count());
    }


}
