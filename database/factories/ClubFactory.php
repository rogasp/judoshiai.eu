<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Club;
use Faker\Generator as Faker;

$factory->define(Club::class, function (Faker $faker) {
    return [
        'name'              => $faker->unique()->company,
        'email'             => $faker->safeEmail,
        'phone'             => $faker->phoneNumber,
        'country'           => $faker->countryCode,
        'user_id'           =>factory(App\User::class),
        'owner_id'          =>factory(App\User::class),
    ];
});
