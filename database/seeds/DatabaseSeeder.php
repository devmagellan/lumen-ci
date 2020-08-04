<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('ProfanitySeeder');
        $this->call('ProfanityIgnoreSeeder');
        $this->call('PropertySeeder');
        $this->call('PropertyItemsSeeder');
        $this->call('TemplateSeeder');
        $this->call('CategorySeeder');
    }
}
