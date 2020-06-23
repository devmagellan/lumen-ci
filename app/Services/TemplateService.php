<?php

namespace WGT\Services;

use WGT\Repositories\TemplateRepository;
use WGT\Services\AbstractService;

class TemplateService extends AbstractService
{
    /**
     * @var TemplateRepository
     */
    protected $repository;

    /**
     * @return void
     */
    public function __construct(TemplateRepository $repository)
    {
        $this->repository = $repository;
    }
}
