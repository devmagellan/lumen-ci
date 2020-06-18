<?php

use Illuminate\Database\Seeder;
use WGT\Models\Profanity\ProfanityIgnore;

class ProfanityIgnoreSeeder extends Seeder
{
    public function run()
    {
        ProfanityIgnore::firstOrCreate([
            'profanity_id' => 1,
            'user_ignored_id' => 1,
            'user_id' => 1,
        ]);
    }
}
