<?php

namespace WGT\GraphQL\Mutations;

use Illuminate\Support\Arr;
use WGT\Models\Firm;
use WGT\Services\FirmService;

class FirmMutator
{
    /**
     * @var FirmService $service
     */
    private $service;

    /**
     * @param FirmService $service
     */
    public function __construct(FirmService $service)
    {
        $this->service = $service;
    }

    /**
     * @param null $root
     * @param array $firm
     * @return Firm
     */
    public function create($root, array $firm): Firm
    {
        return $this->service->create($firm);
    }

    /**
     * @param null $root
     * @param array $firm
     * @return Firm
     */
    public function update($root, array $firm): Firm
    {
        return $this->service->update($firm['firm'], $firm['id']);
    }

    /**
     * @param null $root
     * @param array $firm
     * @return array
     */
    public function delete($root, array $firm): array
    {
        $this->service->delete($firm['id']);

        return ['message' => trans('messages.deleted', ['entity' => 'Firm'])];
    }

    /**
     * @param null $root
     * @param array $data
     * @return array
     */
    public function attachEmployee($root, array $data): array
    {
        $this->service->attachEmployee($data['firmId'], $data['userId'], Arr::only($data, 'position'));

        return ['message' => trans('messages.firm.employee_attached')];
    }

    /**
     * @param null $root
     * @param array $data
     * @return array
     */
    public function detachEmployee($root, array $data): array
    {
        $this->service->detachEmployees($data['firmId'], $data['userId'], $data['position']);

        return ['message' => trans('messages.firm.employee_detached')];
    }
}
