<?php

namespace WGT\GraphQL\Mutations\Auth;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacades;
use WGT\GraphQL\Exceptions\CustomException;

class ForgotPasswordMutator
{
    use SendsPasswordResetEmails;

    /**
     * @param null $root
     * @param array $data
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
     * @return void
     * @throws CustomException
     */
    protected function sendResetLinkResponse(Request $request, $response): void
    {
        throw new CustomException(__($response));
    }

    /**
     * @param Request $request
     * @param string $response
     * @return array
     * @throws CustomException
     */
    protected function sendResetLinkFailedResponse(Request $request, $response): array
    {
        throw new CustomException(__($response));
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
