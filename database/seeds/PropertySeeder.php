<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use WGT\Models\User;

class PropertySeeder extends Seeder
{
    public function run()
    {
        Property::firstOrCreate([
            'display_name' => 'some_name',
            'header_name' => 'some_header',
            'region' => 'some_region',
            'description' => 'description',
            'required' => true,
       ] );

    }
}
