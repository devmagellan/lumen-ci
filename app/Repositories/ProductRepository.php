<?php

namespace WGT\Repositories;

use WGT\Models\Product;
use WGT\Repositories\AbstractRepository;

class ProductRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Product::class;
    }
}
