<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use WGT\Models\Firm;

$factory->define(Firm::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->sentence(3)
    ];
});
