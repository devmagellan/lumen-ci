<?php

namespace WGT\Services;

use WGT\Repositories\CurrencyRepository;
use WGT\Services\AbstractService;

class CurrencyService extends AbstractService
{
    /**
     * @var CurrencyRepository
     */
    protected $repository;

    /**
     * @return void
     */
    public function __construct(CurrencyRepository $repository)
    {
        $this->repository = $repository;
    }
}
