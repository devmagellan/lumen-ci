<?php

use Illuminate\Database\Seeder;

use WGT\Models\Firm;
use WGT\Models\User;

class FirmUserSeeder extends Seeder
{
    public function run()
    {
        $users = User::first();
        Firm::all()->each(function ($firm) use ($users) {
            $faker = \Faker\Factory::create();
            $firm->employees()->attach(
                $users->id,
                ['position' => $faker->jobTitle]
            );
        });
    }
}
