<?php

namespace WGT\Repositories\Profanity;

use WGT\Models\Profanity\ProfanityIgnore;
use WGT\Repositories\AbstractRepository;

class ProfanityIgnoreRepository extends AbstractRepository
{
    public function model()
    {
        return ProfanityIgnore::class;
    }

    public function presenter(): string
    {
        return "WGT\\Presenters\\ProfanityIgnorePresenter";
    }
}
