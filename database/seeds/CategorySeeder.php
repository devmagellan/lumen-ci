<?php

use Illuminate\Database\Seeder;
use WGT\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::firstOrCreate(
            [
                'name' => 'Some aditional category',
                'type'=> 'stone',
                'user_id' => 1,
            ]
        );
    }
}
