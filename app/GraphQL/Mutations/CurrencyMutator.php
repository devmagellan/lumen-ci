<?php

namespace WGT\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use WGT\Models\Currency;
use WGT\Services\CurrencyService;

class CurrencyMutator
{
    /**
     * @var CurrencyService $service
     */
    private $service;

    /**
     * @param CurrencyService $service
     */
    public function __construct(CurrencyService $service)
    {
        $this->service = $service;
    }

    /**
     * @param null $root
     * @param array $currency
     * @return Currency
     */
    public function create($root, array $currency): Currency
    {
        $currency['user_id'] = auth()->user()->id;
        return $this->service->create($currency);
    }

    /**
     * @param null $root
     * @param array $currency
     * @return Currency
     */
    public function update($root, array $currency): Currency
    {
        $currency['user_id'] = auth()->user()->id;
        return $this->service->update($currency, $currency['id']);
    }

    /**
     * @param null $root
     * @param array $currency
     * @return array
     */
    public function delete($root, array $currency): array
    {
        $this->service->delete($currency['id']);

        return ['message' => __('messages.deleted', ['entity' => 'Currency'])];
    }
}
