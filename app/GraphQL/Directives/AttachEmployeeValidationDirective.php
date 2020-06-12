<?php

namespace WGT\GraphQL\Directives;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class AttachEmployeeValidationDirective extends ValidationDirective
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'firm_id' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric'],
            'position' => ['required', Rule::unique('firm_user')->where(function ($query) {
                return $query
                    ->where('firm_id', $this->args()['firm_id'] ?? 0)
                    ->where('user_id', $this->args()['user_id'] ?? 0);
            })],
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
