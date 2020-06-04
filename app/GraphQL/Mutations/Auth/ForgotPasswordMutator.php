<?php

namespace WGT\GraphQL\Mutations\Auth;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacades;

class ForgotPasswordMutator
{
    use SendsPasswordResetEmails;

    /**
     * @param null $root
     * @param array $user
     * @return array
     */
    public function forgotPassword($root, array $data): array
    {
        $request = RequestFacades::replace($data);

        return $this->sendResetLinkEmail($request);
    }

    /**
     * @param Request $request
     * @param string $response
     * @return array
     */
    protected function sendResetLinkResponse(Request $request, $response): array
    {
        return ['message' => trans($response)];
    }

    /**
     * @param Request $request
     * @param string $response
     * @return array
     */
    protected function sendResetLinkFailedResponse(Request $request, $response): array
    {
        return ['message' => trans($response)];
    }

    /**
     * @param Request $request
     * @return void
     */
    protected function validateEmail(Request $request): void
    {
        //
    }
}
