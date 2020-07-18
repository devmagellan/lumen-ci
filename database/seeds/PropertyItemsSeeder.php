<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use WGT\Models\User;

class PropertyItemsSeeder extends Seeder
{
    public function run()
    {
        PropertyItem::firstOrCreate([
            'name' => 'some_name',
            'value' => 'some_value',
            'position' => 1,
       ] );

    }
}
