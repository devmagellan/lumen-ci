<?php

use Illuminate\Database\Seeder;
use WGT\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
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
