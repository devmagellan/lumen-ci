<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use WGT\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    $firstName = $faker->firstName;
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => strtolower($firstName) . '@worldgemtrade.com',
        'password' => 'wgtcrm.123',
        'secret_phrase' => $faker->sentence(2)
    ];
});
