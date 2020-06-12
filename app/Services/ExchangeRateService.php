<?php

namespace WGT\Services;

use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;
use Carbon\Carbon;
use WGT\Services\AbstractService;

class ExchangeRateService extends AbstractService
{
    public function convert(
        float $amount = 1,
        string $from = 'USD',
        string $to = 'USD',
        string $date
    ): array
    {
        $exchangeRates = new ExchangeRate();

        $date = empty($date)
            ? Carbon::now()
            : Carbon::createFromFormat('Y-m-d H:i:s', $date);

        $amountConverted = $exchangeRates->convert($amount, $from, $to, $date);

        return [
            'from' => $from,
            'to' => $to,
            'amountConverted' => $amountConverted,
            'date' => $date
        ];
    }
}
