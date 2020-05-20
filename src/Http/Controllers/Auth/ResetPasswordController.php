<?php

namespace WGT\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use WGT\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function reset(Request $request): JsonResponse
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

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
     * @param string $response
     * @return JsonResponse
     */
    protected function sendResetResponse(Request $request, $response): JsonResponse
    {
        return self::successfulResponse(['message' => trans($response)]);
    }

    /**
     * @param Request $request
     * @param string $response
     * @return JsonResponse
     * @throws ValidationException
     */
    protected function sendResetFailedResponse(Request $request, $response): JsonResponse
    {
        throw ValidationException::withMessages(['email' => [trans($response)]]);
    }
}
