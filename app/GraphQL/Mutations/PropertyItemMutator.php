<?php

namespace WGT\GraphQL\Mutations;

use Illuminate\Support\Arr;
use WGT\Models\Property;
use WGT\Services\PropertyService;

class PropertyItemMutator
{
    /**
     * @var PropertyService $service
     */
    private $service;

    /**
     * @param PropertyService $service
     */
    public function __construct(PropertyService $service)
    {
        $this->service = $service;
    }

    /**
     * @param null $root
     * @param array $args
     * @return Property
     */
    public function create($root, array $args): PropertyItem
    {
        $request = Arr::only($args, ['name', 'value', 'position']);
        $request['user_id'] = auth()->user()->id;
        return $this->service->create($request);
    }

    /**
     * @param null $root
     * @param array $args
     * @return Property
     */
    public function update($root, array $args): PropertyItem
    {
        $request = Arr::only($args, ['id', 'name', 'value', 'position']);
        $request['user_id'] = auth()->user()->id;
        return $this->service->update($request, $request['id']);
    }

    /**
     * @param null $root
     * @param array $args
     * @return array
     */
    public function delete($root, array $args): array
    {
        $this->service->delete($args['id']);

        return ['message' => __('messages.deleted', ['entity' => 'Property'])];
    }


}
