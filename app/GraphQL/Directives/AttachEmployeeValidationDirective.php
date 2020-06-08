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
            'firmId' => ['required', 'numeric'],
            'userId' => ['required', 'numeric'],
            'position' => ['required', Rule::unique('firm_user')->where(function ($query) {
                return $query
                    ->where('firm_id', $this->args()['firmId'] ?? 0)
                    ->where('user_id', $this->args()['userId'] ?? 0)
                    ->where('position', $this->args()['position'] ?? '');
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
