<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Club;
use App\Http\Utilities\Country as Country;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Club::class, function (Faker $faker) {
    return [
        'name'              => $faker->unique()->company,
        'email'             => $faker->safeEmail,
        'phone'             => $faker->phoneNumber,
        'country_code'      => $faker->randomElement(array_keys(Country::all())),
        'approved_at'       => now(),
        'activated_at'      => now(),
        'user_id'           =>factory(App\User::class),
        'owner_id'          =>factory(App\User::class),
    ];
});
