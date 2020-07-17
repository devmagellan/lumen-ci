<?php

namespace WGT\GraphQL\Directives;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class CreatePropertyItemValidationDirective extends ValidationDirective
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
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
