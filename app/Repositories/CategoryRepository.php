<?php

namespace WGT\Repositories;

use WGT\Models\Category;
use WGT\Repositories\AbstractRepository;

class CategoryRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Category::class;
    }

    /**
     * @param array $data
     * @return Category
     */
    public function create(array $data): Category
    {
        $category = $this->model->create($data);
        return $category;
    }

}
