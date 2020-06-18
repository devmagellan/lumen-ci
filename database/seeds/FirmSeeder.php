<?php

use Illuminate\Database\Seeder;

use WGT\Models\Firm;

class FirmSeeder extends Seeder
{
    public function run()
    {
        factory(Firm::class, 2)->create()->each(function($firm){
            $firm->save();
        });
    }
}
