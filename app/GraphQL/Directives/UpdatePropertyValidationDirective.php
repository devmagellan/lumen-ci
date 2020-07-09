<?php

namespace WGT\GraphQL\Directives;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class UpdatePropertyValidationDirective extends ValidationDirective
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id'=>['required', 'exists:WGT\Models\Property,id'],
            'name' => ['required', 'string', 'max:128'],
            'display_name' => ['string'],
            'header_name' => ['string', 'max:255'],
            'region' => ['string'],
            'description' => ['string'],
            'required' => ['boolean'],
            'datatype' => ['filled','string', Rule::in(['text', 'number', 'date', 'single_select', 'multi_select'])],

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
