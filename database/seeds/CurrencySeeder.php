<?php

use Illuminate\Database\Seeder;
use WGT\Models\Country;
use WGT\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Provide from https://www.ecb.europa.eu/stats/policy_and_exchange_rates/euro_reference_exchange_rates/html/index.en.html
     *
     * @return void
     */
    public function run()
    {
        $user_id = 1;
        $currencies = [
            ['code' => 'USD', 'alpha_3_code' => 'USA', 'name' => 'US dollar', 'user_id' => $user_id],
            ['code' => 'JPY', 'alpha_3_code' => 'JPN', 'name' => 'Japanese yen', 'user_id' => $user_id],
            ['code' => 'BGN', 'alpha_3_code' => 'BGR', 'name' => 'Bulgarian lev', 'user_id' => $user_id],
            ['code' => 'CZK', 'alpha_3_code' => 'CZE', 'name' => 'Czech koruna', 'user_id' => $user_id],
            ['code' => 'DKK', 'alpha_3_code' => 'DNK', 'name' => 'Danish krone', 'user_id' => $user_id],
            ['code' => 'GBP', 'alpha_3_code' => 'GBR', 'name' => 'Pound sterling', 'user_id' => $user_id],
            ['code' => 'HUF', 'alpha_3_code' => 'HUN', 'name' => 'Hungarian forint', 'user_id' => $user_id],
            ['code' => 'PLN', 'alpha_3_code' => 'POL', 'name' => 'Polish zloty', 'user_id' => $user_id],
            ['code' => 'RON', 'alpha_3_code' => 'ROU', 'name' => 'Romanian leu', 'user_id' => $user_id],
            ['code' => 'SEK', 'alpha_3_code' => 'SWE', 'name' => 'Swedish krona', 'user_id' => $user_id],
            ['code' => 'CHF', 'alpha_3_code' => 'CHE', 'name' => 'Swiss franc', 'user_id' => $user_id],
            ['code' => 'ISK', 'alpha_3_code' => 'ISL', 'name' => 'Icelandic krona', 'user_id' => $user_id],
            ['code' => 'NOK', 'alpha_3_code' => 'NOR', 'name' => 'Norwegian krone', 'user_id' => $user_id],
            ['code' => 'HRK', 'alpha_3_code' => 'HRV', 'name' => 'Croatian kuna', 'user_id' => $user_id],
            ['code' => 'RUB', 'alpha_3_code' => 'RUS', 'name' => 'Russian rouble', 'user_id' => $user_id],
            ['code' => 'TRY', 'alpha_3_code' => 'TUR', 'name' => 'Turkish lira', 'user_id' => $user_id],
            ['code' => 'AUD', 'alpha_3_code' => 'AUS', 'name' => 'Australian dollar', 'user_id' => $user_id],
            ['code' => 'BRL', 'alpha_3_code' => 'BRA', 'name' => 'Brazilian real', 'user_id' => $user_id],
            ['code' => 'CAD', 'alpha_3_code' => 'CAN', 'name' => 'Canadian dollar', 'user_id' => $user_id],
            ['code' => 'CNY', 'alpha_3_code' => 'CHN', 'name' => 'Chinese yuan renminbi', 'user_id' => $user_id],
            ['code' => 'HKD', 'alpha_3_code' => 'HKG', 'name' => 'Hong Kong dollar', 'user_id' => $user_id],
            ['code' => 'IDR', 'alpha_3_code' => 'IDN', 'name' => 'Indonesian rupiah', 'user_id' => $user_id],
            ['code' => 'ILS', 'alpha_3_code' => 'ISR', 'name' => 'Israeli shekel', 'user_id' => $user_id],
            ['code' => 'INR', 'alpha_3_code' => 'IND', 'name' => 'Indian rupee', 'user_id' => $user_id],
            ['code' => 'KRW', 'alpha_3_code' => 'KOR', 'name' => 'South Korean won', 'user_id' => $user_id],
            ['code' => 'MXN', 'alpha_3_code' => 'MEX', 'name' => 'Mexican peso', 'user_id' => $user_id],
            ['code' => 'MYR', 'alpha_3_code' => 'MYS', 'name' => 'Malaysian ringgit', 'user_id' => $user_id],
            ['code' => 'NZD', 'alpha_3_code' => 'NZL', 'name' => 'New Zealand dollar', 'user_id' => $user_id],
            ['code' => 'PHP', 'alpha_3_code' => 'PHL', 'name' => 'Philippine peso', 'user_id' => $user_id],
            ['code' => 'SGD', 'alpha_3_code' => 'SGP', 'name' => 'Singapore dollar', 'user_id' => $user_id],
            ['code' => 'THB', 'alpha_3_code' => 'THA', 'name' => 'Thai baht', 'user_id' => $user_id],
            ['code' => 'ZAR', 'alpha_3_code' => 'ZAF', 'name' => 'South African rand', 'user_id' => $user_id],
        ];

        foreach ($currencies as $currency) {
            $country = Country::where('alpha_3_code', $currency['alpha_3_code'])
                ->select('id')
                ->first();
            $currency['country_id'] = $country->id;
            Currency::firstOrCreate(['code' => $currency['code']], $currency);
        }
    }
}
