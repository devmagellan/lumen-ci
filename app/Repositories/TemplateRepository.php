<?php

namespace WGT\Repositories;

use WGT\Models\Template;
use WGT\Repositories\AbstractRepository;

class TemplateRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Template::class;
    }
}

