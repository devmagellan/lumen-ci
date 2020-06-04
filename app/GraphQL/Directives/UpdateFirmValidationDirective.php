<?php

namespace WGT\GraphQL\Directives;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class UpdateFirmValidationDirective extends ValidationDirective
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'firm.name' => ['sometimes', 'required', 'string', 'max:128'],
            'firm.description' => ['string'],
            'firm.website' => ['string', 'max:255'],
            'firm.discount' => ['numeric'],
            'firm.type' => ['filled', 'string', Rule::in(['retailer', 'wholesaler', 'association', 'administration', 'customer', 'roughseller', 'miner', 'manufacturer', 'farm', 'laboratory', 'enhancer'])],
            'firm.supplier' => ['string', 'max:255'],
            'firm.status' => ['filled', 'string', Rule::in(['active', 'disabled'])],
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
