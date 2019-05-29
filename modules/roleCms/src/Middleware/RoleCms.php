<?php

namespace Cms\Roles\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Auth\Access\AuthorizationException;

class RoleCms {

    protected $user;

    public function handle($request, Closure $next, $role = null) {

        if (Auth::check()) {
            if ($role && Auth::user()->is($role)) {
                return $next($request);
            }
        }

        throw new AuthorizationException();
        return;
    }

}
