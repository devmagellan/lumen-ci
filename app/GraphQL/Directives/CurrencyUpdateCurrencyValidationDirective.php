<?php

namespace WGT\GraphQL\Directives;

use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;
use Illuminate\Validation\Rule;

class CurrencyUpdateCurrencyValidationDirective extends ValidationDirective
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'code' => [
                'sometimes',
                'required',
                'string',
                'size:3',
                Rule::unique('currencies', 'code')->ignore($this->args['id'], 'id')
            ],
            'country_id' => ['sometimes', 'required', 'integer', 'exists:WGT\Models\Country,id']
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
