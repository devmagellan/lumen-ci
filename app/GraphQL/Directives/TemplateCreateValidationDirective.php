<?php

namespace WGT\GraphQL\Directives;

use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;
use Illuminate\Validation\Rule;

class TemplateCreateValidationDirective extends ValidationDirective
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:WGT\Models\Template,id,deleted_at,NULL'],
            'name' => ['required', 'string', 'min:2', 'max:255']
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
