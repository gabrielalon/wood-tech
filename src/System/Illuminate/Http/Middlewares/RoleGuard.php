<?php declare(strict_types=1);

namespace System\Illuminate\Http\Middlewares;

use Illuminate\Http\Request;
use System\Illuminate\Auth;

final class RoleGuard
{
    public function __construct(
        private readonly Auth $auth,
    ) {
    }

    public function handle(Request $request, \Closure $next, string ...$roles)
    {
        if (false === $this->auth->check()) {
            return redirect()->route('admin.accounts.user.login');
        }

        if (false === $request->user()->hasAnyRole($roles)) {
            return redirect()
                ->route('admin.accounts.user.login')
                ->with(['error' => __('validations.invalid_role')]);
        }

        return $next($request);
    }
}
