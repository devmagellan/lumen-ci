<?php

namespace WGT\GraphQL\Directives;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class CreateCategoryValidationDirective extends ValidationDirective
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['string', Rule::in(['stone','finished_product','parcel'])]
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
