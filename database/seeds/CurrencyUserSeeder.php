<?php

use Illuminate\Database\Seeder;

use WGT\Models\User;
use WGT\Models\Currency;

class CurrencyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency = Currency::first();
        User::where('status', 'active')->update(['currency_id' => $currency->id]);
    }
}
