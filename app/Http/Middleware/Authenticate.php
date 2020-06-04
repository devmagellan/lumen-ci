<?php

namespace WGT\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

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

        App::setLocale($this->auth->user()->locale ?? 'en-US');
        Config::set('app.timezone', $this->auth->user()->timezone ?? 'UTC');
        date_default_timezone_set($this->auth->user()->timezone ?? 'UTC');

        return $next($request);
    }
}
