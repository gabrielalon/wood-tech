<?php

namespace System\Illuminate\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use System\Illuminate\Providers\RouteServiceProvider;
use function redirect;

final class RedirectIfAuthenticated
{
    public function __construct(
        private readonly \System\Illuminate\Auth $auth,
    ) {
    }

    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (true === $this->auth->check() && true === $this->auth->user()->hasAnyRole($roles)) {
            return redirect()->route('admin.dashboard.index');
        }

        return $next($request);
    }
}
