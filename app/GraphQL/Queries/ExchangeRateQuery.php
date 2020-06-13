<?php

namespace WGT\GraphQL\Queries;

use Carbon\Carbon;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Collection;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use WGT\Services\ExchangeRateService;
use WGT\Services\UserService;

class ExchangeRateQuery extends AbstractQuery
{
    /**
     * @var ExchangeRateService
     */
    protected $service;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @param ExchangeRateService $service
     */
    public function __construct(ExchangeRateService $service, UserService $userService)
    {
        $this->service = $service;
        $this->userService = $userService;
    }

    /**
     * @param null $root
     * @param array $args
     * @param GraphQLContext $context
     * @param ResolveInfo $resolveInfo
     * @return array
     */
    public function convertViaUser($root, array $args): array
    {
        $user = $this->userService->find(auth()->user()->id);

        if ($args['conversionType']==='to') {
            $from = $args['currency'];
            $to = $user->currency->code;
        } else {
            $to = $args['currency'];
            $from = $user->currency->code;
        }

        $date = isset($args['date']) ? $args['date'] : Carbon::now();

        return $this->service->convert($args['amount'], $from, $to, $date);
    }

    /**
     * @param null $root
     * @param array $args
     * @param GraphQLContext $context
     * @param ResolveInfo $resolveInfo
     * @return array
     */
    public function convert($root, array $args): array
    {
        $amount = isset($args['amount'])
            ? floatval($args['amount'])
            : 1;

        $date = isset($args['date']) ? $args['date'] : Carbon::now();

        return $this->service->convert($amount, $args['from'], $args['to'], $date);
    }
}
