<?php

namespace WGT\GraphQL\Directives;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class UpdateProfanityValidationDirective extends ValidationDirective
{
    public function rules(): array
    {
        return [
            'word' => [
                'required',
                'string',
                'min:2',
                'max:255',
                Rule::unique('profanities', 'word')->ignore($this->args['id'], 'id'),
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
