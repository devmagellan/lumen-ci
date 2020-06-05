<?php

namespace WGT\Services;

use WGT\Repositories\FirmRepository;
use WGT\Services\AbstractService;

class FirmService extends AbstractService
{
    /**
     * @var FirmRepository
     */
    protected $repository;

    /**
     * @return void
     */
    public function __construct(FirmRepository $repository)
    {
        $this->repository = $repository;
    }
}
