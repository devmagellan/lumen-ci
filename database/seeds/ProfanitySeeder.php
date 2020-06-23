<?php

use Illuminate\Database\Seeder;
use WGT\Models\Profanity;

class ProfanitySeeder extends Seeder
{
    public function run()
    {
        $userId = 1;
        $words = ['fuck', 'fuck you', 'shit', 'bitch'];

        foreach ($words as $word) {
            Profanity::firstOrCreate([
                'word' => $word,
                'user_id' => $userId,
            ]);
        }
    }
}
