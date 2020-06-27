<?php

namespace WGT\Http\Middleware;

use Closure;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PermissionMiddleware
{
    /**
     * @param mixed $request
     * @param Closure $next
     * @param mixed $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (app('auth')->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        $user = app('auth')->user();
        $permissions = is_array($permission) ? $permission : explode('|', $permission);

        foreach ($permissions as $permission) {
            if ($user->can($permission)) {
                return $next($request);
            }

            $allPermissions = $user->getAllPermissions()->pluck('name')->toArray();
            if (in_array($permission, $allPermissions)) {
                return $next($request);
            }
        }

        throw UnauthorizedException::forPermissions($permissions);
    }
}
