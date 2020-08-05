<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use WGT\Models\Position;

$factory->define(Position::class, function (Faker $faker) {
    return [
        'firm_id' => 0,
        'name' => $faker->name,
        'description' => $faker->text,
    ];
});
