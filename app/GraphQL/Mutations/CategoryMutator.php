<?php

namespace WGT\GraphQL\Mutations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use WGT\Models\Category;
use WGT\Services\CategoryService;

class CategoryMutator
{
    /**
     * @var CategoryService $service
     */
    private $service;

    /**
     * @param CategoryService $service
     */
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * @param null $root
     * @param array $category
     * @return Category
     */
    public function create($root, array $category): Category
    {
        $category = Arr::only($category,  ['name', 'type']);
        $request['user_id'] = auth()->user()->id;
        return $this->service->create($request);
    }

    /**
     * @param null $root
     * @param array $firm
     * @return Category
     */
    public function update($root, array $category): Category
    {
        $request = Arr::only($category, ['id', 'name', 'type']);
        $request['user_id'] = auth()->user()->id;
        return $this->service->update($request, $request['id']);
    }

    /**
     * @param null $root
     * @param array $category
     * @return array
     */
    public function delete($root, array $category): array
    {
        $this->service->delete($category['id']);

        return ['message' => __('messages.deleted', ['entity' => 'Category'])];
    }


}
