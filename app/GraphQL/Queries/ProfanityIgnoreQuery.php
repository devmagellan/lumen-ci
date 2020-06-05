<?php

namespace WGT\GraphQL\Queries;

use Illuminate\Database\Eloquent\Model;

use WGT\Services\ProfanityIgnoreService;

use WGT\Models\Profanity\ProfanityIgnore;
use Log;
class ProfanityIgnoreQuery extends AbstractQuery
{
    protected $service;

    public function __construct(ProfanityIgnoreService $service)
    {
        $this->service = $service;
    }

    public function find($root, array $args): Model
    {
        $value = $this->service->with(['user'])->find($args['id'])['data'] ?? [];
        Log::info($value);
        return $value;
    }
}
