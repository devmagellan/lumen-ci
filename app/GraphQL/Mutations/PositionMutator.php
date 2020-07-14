<?php

namespace WGT\GraphQL\Mutations;

use Illuminate\Support\Arr;
use WGT\Models\Position;
use WGT\Services\PositionService;

class PositionMutator
{
    /**
     * @var PositionService $service
     */
    private $service;

    /**
     * @param PositionService $service
     */
    public function __construct(PositionService $service)
    {
        $this->service = $service;
    }

    /**
     * @param null $root
     * @param array $position
     * @return Position
     */
    public function create($root, array $position): Position
    {
        $position = Arr::except($position, 'directive');

        return $this->service->create($position);
    }

    /**
     * @param null $root
     * @param array $position
     * @return Position
     */
    public function update($root, array $position): Position
    {
        return $this->service->update($position['position'], $position['id']);
    }

    /**
     * @param null $root
     * @param array $position
     * @return array
     */
    public function delete($root, array $position): array
    {
        $this->service->delete($position['id']);

        return ['message' => __('messages.deleted', ['entity' => 'Position'])];
    }

    /**
     * @param null $root
     * @param array $data
     * @return array
     */
    public function givePermission($root, array $data): array
    {
        $this->service->givePermission($data['id'], $data['permission_id']);

        return ['message' => __('messages.attached', ['entity' => 'Position'])];
    }

    /**
     * @param null $root
     * @param array $data
     * @return array
     */
    public function revokePermission($root, array $data): array
    {
        $this->service->revokePermission($data['id'], $data['permission_id']);

        return ['message' => __('messages.detached', ['entity' => 'Position'])];
    }
}
