<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use WGT\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@worldgemtrade.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'WGT',
                'secret_phrase' => 'hello world',
                'password' => 'wgtcrm.123',
            ]
        );

        if (!App::environment('production')) {
            User::firstOrCreate(
                ['email' => 'dev@worldgemtrade.com'],
                [
                    'first_name' => 'Dev',
                    'last_name' => 'WGT',
                    'secret_phrase' => 'hello world',
                    'password' => 'wgtcrm.123',
                ]
            );
        }
    }
}
