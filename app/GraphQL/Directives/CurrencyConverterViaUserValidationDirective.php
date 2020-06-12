<?php

namespace WGT\GraphQL\Directives;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class CurrencyConverterViaUserValidationDirective extends ValidationDirective
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'conversionType' => ["required", "string", Rule::in(['from', 'to'])],
            'amount' => ["required", "numeric", "gt:0"],
            'currency' => ["required", "string", "size:3", "exists:WGT\Models\Currency,code"]
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [];
    }
}
