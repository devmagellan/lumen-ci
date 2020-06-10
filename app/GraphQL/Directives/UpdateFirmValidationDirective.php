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
            'address.address' => ['sometimes', 'required', 'string', 'max:255'],
            'address.fax' => ['string', 'max:16'],
            'address.phone' => ['string', 'max:16'],
            'address.postal_code' => ['string', 'max:16'],
            'address.alt_phone' => ['string', 'max:16'],
            'address.city' => ['sometimes', 'required', 'string', 'max:64'],
            'address.state' => ['sometimes', 'required', 'string', 'max:64'],
            'address.country' => ['sometimes', 'required', 'string', 'max:2'],
            'extra.locale' => ['string', 'max:8'],
            'extra.timezone' => ['string', 'max:64'],
            'extra.currency' => ['string', 'max:3'],
            'extra.contact_name' => ['string', 'max:64'],
            'extra.email' => ['string', 'max:255'],
            'extra.logo' => ['numeric'],
            'extra.header_logo' => ['numeric'],
            'extra.mobile_header_logo' => ['numeric'],
            'extra.headline' => ['string', 'max:256'],
            'extra.discount_fee' => ['numeric'],
            'extra.as_discount_fee' => ['numeric'],
            'extra.default_association' => ['numeric'],
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
