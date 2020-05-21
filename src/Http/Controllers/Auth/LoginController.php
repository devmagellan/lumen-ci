<?php

namespace WGT\Http\Controllers\Auth;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use WGT\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->all(['email', 'password']);
        if (!$token = Auth::attempt($credentials)) {
            throw new AuthenticationException(__('auth.unauthenticated'));
        }

        return self::successfulResponse(self::respondWithToken($token));
    }

    /**
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return self::successfulResponse(['me' => Auth::user()]);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::logout();

        return self::successfulResponse();
    }

    /**
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        $token = Auth::refresh();

        return self::successfulResponse(self::respondWithToken($token));
    }

    /**
     * @param string $token
     * @return array
     */
    protected static function respondWithToken($token): array
    {
        return [
            'auth' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::factory()->getTTL() * 60,
            ],
        ];
    }
}
