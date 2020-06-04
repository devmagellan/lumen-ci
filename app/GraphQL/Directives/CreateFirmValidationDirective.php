<?php

namespace WGT\GraphQL\Directives;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class CreateFirmValidationDirective extends ValidationDirective
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:128'],
            'description' => ['sometimes', 'string'],
            'website' => ['sometimes', 'string', 'max:255'],
            'discount' => ['sometimes', 'numeric'],
            'type' => ['sometimes', 'string', Rule::in(['retailer', 'wholesaler', 'association', 'administration', 'customer', 'roughseller', 'miner', 'manufacturer', 'farm', 'laboratory', 'enhancer'])],
            'supplier' => ['sometimes', 'string', 'max:255'],
            'status' => ['sometimes', 'string', Rule::in(['active', 'disabled'])],
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
