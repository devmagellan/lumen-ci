<?php

namespace WGT\Repositories;

use WGT\Models\Firm;
use WGT\Repositories\AbstractRepository;

class FirmRepository extends AbstractRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name' => 'like',
        'description' => 'like',
        'website' => 'like',
    ];

    /**
     * @return string
     */
    public function model(): string
    {
        return Firm::class;
    }
}
