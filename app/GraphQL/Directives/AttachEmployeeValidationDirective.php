<?php

namespace WGT\GraphQL\Directives;

use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class AttachEmployeeValidationDirective extends ValidationDirective
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric'],
            'position_id' => ['required', 'numeric'],
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
