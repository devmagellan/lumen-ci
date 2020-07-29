<?php

namespace WGT\GraphQL\Mutations\Auth;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Request as RequestFacades;
use WGT\GraphQL\Exceptions\CustomException;

class ResetPasswordMutator
{
    use ResetsPasswords;

    /**
     * @param null $root
     * @param array $data
     * @return array
     */
    public function reset($root, array $data): array
    {
        $request = RequestFacades::replace($data);

        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
            $this->resetPassword($user, $password);
        }
        );

        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token', 'secret_phrase'
        );
    }

    /**
     * @param Request $request
     * @param string $response
     * @return array
     * @throws CustomException
     */
    protected function sendResetResponse(Request $request, $response): array
    {
        throw new CustomException(__($response));
    }

    /**
     * @param Request $request
     * @param string $response
     * @return array
     * @throws CustomException
     */
    protected function sendResetFailedResponse(Request $request, $response): array
    {
        throw new CustomException(__($response));
    }
}
