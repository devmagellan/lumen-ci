<?php

use Illuminate\Database\Seeder;
use WGT\Models\Firm;

class FirmSeeder extends Seeder
{
    public function run()
    {
        Firm::firstOrCreate(
            ['website' => 'https://www.worldgemtrade.com'],
            [
                'name' => 'World Gem Trade',
                'description' => 'World Gem Trade is a sophisticated online network that empowers qualified jewelry professionals to buy and sell jewelry, diamonds, gemstones, watches and trace their stock through the supply chain to achieve provenance.',
            ]
        );
    }
}
