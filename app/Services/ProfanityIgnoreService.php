<?php

namespace WGT\Services;

use WGT\Repositories\Profanity\ProfanityIgnoreRepository;
use WGT\Services\AbstractService;

class ProfanityIgnoreService extends AbstractService
{
    protected $repository;

    public function __construct(ProfanityIgnoreRepository $repository)
    {
        $this->repository = $repository;
    }
}
