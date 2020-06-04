<?php

namespace WGT\Repositories\Firm;

use WGT\Models\Firm\Extra;
use WGT\Repositories\AbstractRepository;

class ExtraRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Extra::class;
    }
}
