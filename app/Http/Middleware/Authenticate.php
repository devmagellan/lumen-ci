<?php

namespace WGT\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use WGT\Models\User;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            throw new AuthenticationException(__('auth.unauthenticated'));
        }

        $this->loadAuthedUserLocale($this->auth->user());
        $this->loadAuthedUserTimezone($this->auth->user());

        return $next($request);
    }

    /**
     * @param User $authUser
     * @return void
     */
    private function loadAuthedUserTimezone(User $authUser): void
    {
        if (empty($authUser->timezone)) {
            return;
        }

        Config::set('app.timezone', $authUser->timezone);
        date_default_timezone_set($authUser->timezone);
    }

    /**
     * @param User $authUser
     * @return void
     */
    private function loadAuthedUserLocale(User $authUser): void
    {
        if (empty($authUser->locale)) {
            return;
        }

        App::setLocale($authUser->locale);
    }
}
