<?php

namespace WGT\GraphQL\Directives;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class AttachPermissionValidationDirective extends ValidationDirective
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'role_id' => ['required', 'numeric'],
            'permission_id' => ['required', Rule::unique('role_has_permissions')->where(function ($query) {
                return $query->where('role_id', $this->args()['role_id'] ?? 0);
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
