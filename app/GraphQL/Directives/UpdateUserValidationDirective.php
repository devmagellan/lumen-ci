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
            'middle_name' => ['string', 'max:64'],
            'last_name' => ['sometimes', 'required', 'string', 'max:64'],
            'gender' => ['string', 'max:16'],
            'birthdate' => ['date'],
            'email' => ['sometimes', 'required', 'string', 'email', 'max:64', "unique:users,email,{$userId}"],
            'business_email' => ['sometimes', 'required', 'string', 'email', 'max:64', "unique:users,business_email,{$userId}"],
            'phone' => ['string', 'max:16'],
            'mobile' => ['string', 'max:16'],
            'business_phone' => ['string', 'max:16'],
            'business_phone_extension' => ['string', 'max:16'],
            'business_mobile' => ['string', 'max:16'],
            'toll_free_business_number' => ['string', 'max:64'],
            'address' => ['string', 'max:16'],
            'city' => ['string', 'max:64'],
            'state' => ['string', 'max:64'],
            'country' => ['string', 'max:2'],
            'zip_code' => ['string', 'max:16'],
            'password' => ['string', 'max:64'],
            'secret_phrase' => ['string', 'max:25'],
            'fingerprint_code' => ['string', 'max:25'],
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
