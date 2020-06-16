<?php

namespace WGT\Repositories;

use WGT\Repositories\AbstractRepository;
use WGT\Models\Currency;

class CurrencyRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Currency::class;
    }
}
