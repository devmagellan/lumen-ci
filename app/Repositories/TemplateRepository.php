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

    /**
     * @param int $templateId
     * @param array $templateFieldData
     * @return bool
     */
    public function createField(int $templateId, array $templateFieldData): bool
    {
        $this->model->find($templateId)->fields()->create($templateFieldData);
        return true;
    }
}

