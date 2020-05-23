<?php

namespace WGT\Http\Controllers\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Urameshibr\Requests\FormRequest;

class UpdateUser extends FormRequest
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
        $userId = Auth::user()->id ?? 0;

        return [
            'email' => "sometimes|required|email|unique:users,email,{$userId}",
            'first_name' => 'sometimes|required',
            'last_name' => 'sometimes|required',
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
