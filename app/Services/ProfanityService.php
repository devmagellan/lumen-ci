<?php

namespace WGT\Services;

use WGT\Repositories\ProfanityRepository;
use WGT\Services\AbstractService;

class ProfanityService extends AbstractService
{
    /**
     * @var ProfanityRepository
     */
    protected $repository;

    /**
     * @return void
     */
    public function __construct(ProfanityRepository $repository)
    {
        $this->repository = $repository;
    }
}
