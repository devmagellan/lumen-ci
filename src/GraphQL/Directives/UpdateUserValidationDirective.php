<?php

namespace WGT\GraphQL\Directives;

use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class UpdateUserValidationDirective extends ValidationDirective
{
    /**
     * @return array
     */
    public function rules(): array
    {
        $userId = Auth::user()->id ?? 0;

        return [
            'first_name' => ['sometimes', 'required', 'string', 'max:255'],
            'last_name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'string', 'email', 'max:255', "unique:users,email,{$userId}"],
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
