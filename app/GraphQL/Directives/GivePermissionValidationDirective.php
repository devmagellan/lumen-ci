<?php

namespace WGT\GraphQL\Directives;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;
use WGT\Models\User;

class GivePermissionValidationDirective extends ValidationDirective
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'numeric'],
            'permission_id' => ['required', Rule::unique('model_has_permissions')->where(function ($query) {
                return $query
                    ->where('model_id', $this->args()['id'] ?? 0)
                    ->where('model_type', User::class);
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
