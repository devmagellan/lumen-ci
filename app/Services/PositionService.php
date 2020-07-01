<?php

namespace WGT\Services;

use WGT\Repositories\PositionRepository;
use WGT\Services\AbstractService;

class PositionService extends AbstractService
{
    /**
     * @var PositionRepository
     */
    protected $repository;

    /**
     * @return void
     */
    public function __construct(PositionRepository $repository)
    {
        $this->repository = $repository;
    }
}
