<?php

namespace WGT\GraphQL\Mutations;

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
     * @return array
     */
    public function create($root, array $firm): array
    {
        return $this->service->create($firm)['data'] ?? [];
    }

    /**
     * @param null $root
     * @param array $firm
     * @return array
     */
    public function update($root, array $firm): array
    {
        return $this->service->update($firm, $firm['id'])['data'] ?? [];
    }
}
