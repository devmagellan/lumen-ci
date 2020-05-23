<?php

namespace WGT\Http\Controllers\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Urameshibr\Requests\FormRequest;

class UpdateFirm extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(Request $request): array
    {
        return [
            'name' => 'sometimes|required|max:128',
            'description' => 'sometimes|required',
            'website' => 'sometimes|url|required|max:255',
            'address' => 'array',
            'address.country' => 'max:2',
            'extra' => 'array',
            'extra.currency' => 'max:3',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * @param Validator $validator
     * @return void
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new ValidationException($validator);
    }
}
