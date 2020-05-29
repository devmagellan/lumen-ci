<?php

namespace WGT\GraphQL\Directives;

use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class ResetPasswordValidationDirective extends ValidationDirective
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'password' => ['required', 'string', 'min:8', 'max:12', 'confirmed'],
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
