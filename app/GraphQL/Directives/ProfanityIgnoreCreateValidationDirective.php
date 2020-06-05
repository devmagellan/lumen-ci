<?php

namespace WGT\GraphQL\Directives;

use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class ProfanityIgnoreCreateValidationDirective extends ValidationDirective
{
    public function rules(): array
    {
        return [
            'profanity_id' => ['required', 'exists:WGT\Models\Profanity,id'],
            'user_ignored_id' => ['nullable', 'exists:WGT\Models\User,id' ],
            'firm_ignored_id' => ['nullable', 'required_without:user_ignored_id', 'exists:WGT\Models\Firm,id' ]
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
