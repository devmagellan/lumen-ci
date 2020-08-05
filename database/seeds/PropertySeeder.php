<?php

use Illuminate\Database\Seeder;
use WGT\Models\Property;

class PropertySeeder extends Seeder
{
    public function run()
    {
        Property::firstOrCreate([
            'name' => 'some name',
            'display_name' => 'some_name',
            'header_name' => 'some_header',
            'region' => 'some_region',
            'description' => 'description',
            'required' => true,
       ] );

    }
}
