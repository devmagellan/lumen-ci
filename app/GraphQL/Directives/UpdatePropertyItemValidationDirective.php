<?php

namespace WGT\GraphQL\Directives;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class UpdatePropertyItemValidationDirective extends ValidationDirective
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id'=>['required', 'exists:WGT\Models\Property,id'],
            'name' => ['required', 'string', 'max:128'],
            'value' => ['required', 'string'],
            'position' => ['required','string', 'max:255'],

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
