<?php

namespace WGT\GraphQL\Directives;

use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class CurrencyCreateCurrencyValidationDirective extends ValidationDirective
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'size:3', 'unique:WGT\Models\Currency,code'],
            'country_id' => ['required', 'integer', 'exists:WGT\Models\Country,id']
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
