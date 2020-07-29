<?php

namespace WGT\GraphQL\Directives;

use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Nuwave\Lighthouse\Exceptions\AuthenticationException;
use Nuwave\Lighthouse\Schema\Directives\GuardDirective as BaseGuardDirective;
use WGT\Models\User;

class GuardDirective extends BaseGuardDirective
{
    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param  string[]  $guards
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate(array $guards): void
    {
        if (empty($guards)) {
            $guards = [config('lighthouse.guard')];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->guest()) {
                $this->unauthenticated($guards);
                return;
            }

            $this->auth->shouldUse($guard);

            $this->loadAuthedUserLocale($this->auth->user());
            $this->loadAuthedUserTimezone($this->auth->user());
        }

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

    /**
     * Handle an unauthenticated user.
     *
     * @param  array<string|null>  $guards
     */
    protected function unauthenticated(array $guards): void
    {
        throw new AuthenticationException('UNAUTHENTICATED', $guards);
    }
}
