<?php

namespace WGT\GraphQL\Mutations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use WGT\Models\Profanity;
use WGT\Services\ProfanityService;

class ProfanityMutator
{
    /**
     * @var ProfanityService $service
     */
    private $service;

    /**
     * @param ProfanityService $service
     */
    public function __construct(ProfanityService $service)
    {
        $this->service = $service;
    }

    /**
     * @param null $root
     * @param array $args
     * @return Profanity
     */
    public function create($root, array $args): Profanity
    {
        $request = Arr::only($args, ['word']);
        $request['user_id'] = auth()->user()->id;
        return $this->service->create($request);
    }

    /**
     * @param null $root
     * @param array $args
     * @return Profanity
     */
    public function update($root, array $args): Profanity
    {
        $request = Arr::only($args, ['id', 'word']);
        $request['user_id'] = auth()->user()->id;
        return $this->service->update($request, $request['id']);
    }

    /**
     * @param null $root
     * @param array $currency
     * @return array
     */
    public function delete($root, array $args): array
    {
        $this->service->delete($args['id']);

        return ['message' => __('messages.deleted', ['entity' => 'Profanity'])];
    }
}
