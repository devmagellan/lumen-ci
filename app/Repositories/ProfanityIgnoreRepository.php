<?php

namespace WGT\Repositories;

use WGT\Models\Profanity\ProfanityIgnore;
use WGT\Repositories\AbstractRepository;

class ProfanityIgnoreRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return ProfanityIgnore::class;
    }
}
