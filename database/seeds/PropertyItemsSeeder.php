<?php

use Illuminate\Database\Seeder;
use WGT\Models\PropertyItem;

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
