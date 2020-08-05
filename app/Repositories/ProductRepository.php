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

    /**
     * @param int $productId
     * @param array $firmIds
     * @return bool
     */
    public function attachFirms(int $productId, array $firmIds): bool
    {
        $this->model->find($productId)->firms()->syncWithoutDetaching($firmIds);

        return true;
    }

    /**
     * @param int $productId
     * @param array $firmIds
     * @return bool
     */
    public function detachFirms(int $productId, array $firmIds): bool
    {
        return $this->model->find($productId)->firms()->detach($firmIds);
    }
}
