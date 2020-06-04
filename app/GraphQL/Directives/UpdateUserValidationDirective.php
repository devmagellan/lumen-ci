<?php

namespace WGT\GraphQL\Directives;

use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Schema\Directives\ValidationDirective;

class UpdateUserValidationDirective extends ValidationDirective
{
    /**
     * @return array
     */
    public function rules(): array
    {
        $userId = Auth::user()->id ?? 0;

        return [
            'first_name' => ['sometimes', 'required', 'string', 'max:64'],
            'middle_name' => ['sometimes', 'string', 'max:64'],
            'last_name' => ['sometimes', 'required', 'string', 'max:64'],
            'gender' => ['sometimes', 'string', 'max:16'],
            'birthdate' => ['sometimes', 'date'],
            'email' => ['sometimes', 'required', 'string', 'email', 'max:64', "unique:users,email,{$userId}"],
            'business_email' => ['sometimes', 'required', 'string', 'email', 'max:64', "unique:users,business_email,{$userId}"],
            'phone' => ['sometimes', 'string', 'max:16'],
            'mobile' => ['sometimes', 'string', 'max:16'],
            'business_phone' => ['sometimes', 'string', 'max:16'],
            'business_phone_extension' => ['sometimes', 'string', 'max:16'],
            'business_mobile' => ['sometimes', 'string', 'max:16'],
            'toll_free_business_number' => ['sometimes', 'string', 'max:64'],
            'address' => ['sometimes', 'string', 'max:16'],
            'city' => ['sometimes', 'string', 'max:64'],
            'state' => ['sometimes', 'string', 'max:64'],
            'country' => ['sometimes', 'string', 'max:2'],
            'zip_code' => ['sometimes', 'string', 'max:16'],
            'password' => ['sometimes', 'string', 'max:64'],
            'secret_phrase' => ['sometimes', 'string', 'max:25'],
            'fingerprint_code' => ['sometimes', 'string', 'max:25'],
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
