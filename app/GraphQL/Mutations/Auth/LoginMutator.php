<?php

namespace WGT\GraphQL\Mutations\Auth;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class LoginMutator
{
    use LogsActivity;

    /**
     * @param null $root
     * @param array $login
     * @return array
     */
    public function login($root, array $login): array
    {
        $credentials = Arr::only($login, ['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            throw new AuthenticationException(__('auth.unauthenticated'));
        }

        $userAuthenticated = auth()->user();

        activity()
            ->causedBy($userAuthenticated)
            ->performedOn($userAuthenticated)
            ->withProperties(['email' => $credentials['email']])
            ->log('Authenticated');

        return self::format($token);
    }

    /**
     * @return bool
     */
    public function logout(): bool
    {
        $userAuthenticated = auth()->user();

        activity()
            ->causedBy($userAuthenticated)
            ->performedOn($userAuthenticated)
            ->withProperties(['email' => $userAuthenticated['email']])
            ->log('Logout');

        Auth::logout();

        return true;
    }

    /**
     * @return array
     */
    public function refresh(): array
    {
        $token = Auth::refresh();

        return self::format($token);
    }

    /**
     * @param string $token
     * @return array
     */
    private static function format(string $token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
        ];
    }

}
