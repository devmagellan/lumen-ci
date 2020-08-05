<?php

namespace WGT\GraphQL\Mutations;

use Illuminate\Support\Arr;
use WGT\Models\Product;
use WGT\Services\ProductService;

class ProductMutator
{
    /**
     * @var ProductService $service
     */
    private $service;

    /**
     * @param ProductService $service
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * @param null $root
     * @param array $product
     * @return Product
     */
    public function create($root, array $product): Product
    {
        $product = Arr::except($product, 'directive');

        return $this->service->create($product);
    }

    /**
     * @param null $root
     * @param array $product
     * @return Product
     */
    public function update($root, array $product): Product
    {
        return $this->service->update($product['firm'], $product['id']);
    }

    /**
     * @param null $root
     * @param array $product
     * @return array
     */
    public function delete($root, array $product): array
    {
        $this->service->delete($product['id']);

        return ['message' => __('messages.deleted', ['entity' => 'Product'])];
    }

    /**
     * @param null $root
     * @param array $data
     * @return array
     */
    public function attachFirm($root, array $data): array
    {
        $this->service->attachFirms($data['id'], [$data['firm_id']]);

        return ['message' => __('messages.attached', ['entity' => 'Firm'])];
    }

    /**
     * @param null $root
     * @param array $data
     * @return array
     */
    public function detachFirm($root, array $data): array
    {
        $this->service->detachFirms($data['id'], [$data['firm_id']]);

        return ['message' => __('messages.detached', ['entity' => 'Firm'])];
    }
}
