<?php

namespace WGT\GraphQL\Directives;

use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class ProfanityIgnoreUpdateValidationDirective extends ValidationDirective
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'exists:WGT\Models\Profanity\ProfanityIgnore,id'],
            'profanity_id' => ['required', 'exists:WGT\Models\Profanity,id'],
            'user_ignored_id' => ['sometimes', 'exists:WGT\Models\User,id' ],
            'firm_ignored_id' => ['sometimes', 'exists:WGT\Models\Firm,id' ]
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
