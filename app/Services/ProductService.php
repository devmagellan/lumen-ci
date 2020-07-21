<?php

namespace WGT\Services;

use WGT\Repositories\ProductRepository;
use WGT\Services\AbstractService;

class ProductService extends AbstractService
{
    /**
     * @param ProductRepository $repository
     * @return void
     */
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }
}
