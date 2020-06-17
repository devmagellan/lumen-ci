<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use WGT\Models\Firm;

class FirmSeeder extends Seeder
{
    public function run()
    {
        if (App::environment('local')) {
            factory(Firm::class, 2)->create()->each(function ($firm) {
                $firm->save();
            });
        }
    }
}
