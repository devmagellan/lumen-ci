<?php

namespace WGT\GraphQL\Directives;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class UpdateCategoryValidationDirective extends ValidationDirective
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'exists:WGT\Models\Category,id'],
            'name' => ['sometimes', 'required', 'string', 'max:128'],
            'type' => ['filled', 'string', Rule::in(['stone','finished_product','parcel'])],
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
