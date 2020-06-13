<?php

namespace WGT\GraphQL\Directives;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class ProfanityIgnoreUpdateValidationDirective extends ValidationDirective
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'exists:WGT\Models\Profanity\ProfanityIgnore,id'],
            'profanity_id' => ['required', 'exists:WGT\Models\Profanity,id'],
            'user_ignored_id' => ['sometimes', 'exists:WGT\Models\User,id' ],
            'firm_ignored_id' => ['sometimes', 'exists:WGT\Models\Firm,id' ],
            'network_ignored_id' => [
                'sometimes',
                'string',
                Rule::in(['retailer', 'wholesaler', 'association', 'administration', 'customer', 'roughseller', 'miner', 'manufacturer', 'farm', 'laboratory', 'enhancer']),
            ]
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
