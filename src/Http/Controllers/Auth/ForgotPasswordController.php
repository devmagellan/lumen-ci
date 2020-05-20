<?php

namespace WGT\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use WGT\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->broker = 'users';
    }

    /**
     * @param Request $request
     * @return void
     */
    protected function validateEmail(Request $request): void
    {
        $this->validate($request, ['email' => 'required|email']);
    }

    /**
     * @param Request $request
     * @param string $response
     * @return JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response): JsonResponse
    {
        return self::successfulResponse(['message' => trans($response)]);
    }

    /**
     * @param Request $request
     * @param string $response
     * @throws ValidationException
     */
    protected function sendResetLinkFailedResponse(Request $request, $response): void
    {
        throw ValidationException::withMessages(['email' => [trans($response)]]);
    }
}
