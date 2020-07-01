<?php

use Illuminate\Database\Seeder;
use WGT\Models\User;
use WGT\Models\TemplateField;

class TemplateFieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $devUser = User::where('email', 'dev@worldgemtrade.com')->first();
        if (!empty($devUser)) {
            TemplateField::firstOrCreate([
                'name' => 'Jewelry Type',
                'template_id' => 1,
                'datatype_id' => 1,
                'position' => 1,
                'group_name' => 'Default',
                'user_id' => $devUser->id
            ]);
        }
    }
}
