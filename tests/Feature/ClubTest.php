<?php

namespace Tests\Feature;

use App\Club;
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

    public function get_is_club_activated()
    {
        //
    }
}
