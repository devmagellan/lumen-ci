<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('UserSeeder');
        $this->call('FirmSeeder');
        $this->call('ProfanitySeeder');
        $this->call('ProfanityIgnoreSeeder');
    }
}
