<?php

namespace WGT\GraphQL\Directives;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class UpdateProductValidationDirective extends ValidationDirective
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:64'],
            'description' => ['string'],
            'type' => ['string', Rule::in(['item', 'package'])],
            'price' => ['numeric'],
            'association_discount' => ['numeric'],
            'retail_price' => ['numeric'],
            'report_price' => ['numeric'],
            'cost' => ['numeric'],
            'visible' => ['string', Rule::in(['public', 'private', 'member'])],
            'status' => ['string', Rule::in(['display', 'sale', 'sold', 'pending'])],
            'active' => ['boolean'],
            'vendor_sku' => ['string'],
            'anonymous' => ['boolean'],
            'matching' => ['integer'],
            'association_product' => ['string'],
            'matching_sku' => ['string'],
            'currency_id' => ['sometimes', 'required', 'integer'],
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
