<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use WGT\Models\Profanity;
use WGT\Models\User;

$factory->define(Profanity::class, function (Faker $faker) {
    return [
        'word' => $faker->sentence(1),
        'user_id' => factory(User::class)
    ];
});
