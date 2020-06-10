<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use WGT\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'first_name' => 'Dev',
            'last_name' => 'WGT',
            'email' => 'dev@worldgemtrade.com',
            'secret_phrase' => 'hello world',
            'password' => 'wgtcrm.123'
        ]);
    }
}
