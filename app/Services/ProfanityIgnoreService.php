<?php

namespace WGT\Services;

use WGT\Repositories\ProfanityIgnoreRepository;
use WGT\Services\AbstractService;

class ProfanityIgnoreService extends AbstractService
{
    /**
     * @var ProfanityIgnoreRepository
     */
    protected $repository;

    /**
     * @return void
     */
    public function __construct(ProfanityIgnoreRepository $repository)
    {
        $this->repository = $repository;
    }
}
