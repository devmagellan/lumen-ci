<?php

namespace WGT\GraphQL\Mutations\Profanity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use WGT\Models\Profanity\ProfanityIgnore;
use WGT\Services\ProfanityIgnoreService;

class ProfanityIgnoreMutator
{
    /**
     * @var ProfanityIgnoreService $service
     */
    private $service;

    /**
     * @param ProfanityIgnoreService $service
     */
    public function __construct(ProfanityIgnoreService $service)
    {
        $this->service = $service;
    }

    /**
     * @param null $root
     * @param array $args
     * @return ProfanityIgnore
     */
    public function create($root, array $args): ProfanityIgnore
    {
        $request = Arr::only(
            $args, ['profanity_id', 'user_ignored_id', 'firm_ignored_id', 'network_ignored_id']
        );
        $request['user_id'] = auth()->user()->id;
        return $this->service->create($request);
    }

    /**
     * @param null $root
     * @param array $args
     * @return ProfanityIgnore
     */
    public function update($root, array $args): ProfanityIgnore
    {
        $request = Arr::only(
            $args,
            ['id', 'profanity_id', 'user_ignored_id', 'firm_ignored_id', 'network_ignored_id']
        );
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

        return ['message' => trans('messages.deleted', ['entity' => 'Profanity Ignore'])];
    }
}
