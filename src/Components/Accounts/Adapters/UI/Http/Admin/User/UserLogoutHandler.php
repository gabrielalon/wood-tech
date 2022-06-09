<?php declare(strict_types=1);

namespace Components\Accounts\Adapters\UI\Http\Admin\User;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use System\Illuminate\Auth;
use System\Illuminate\Http\WebHandler;
use function redirect;

final class UserLogoutHandler extends WebHandler
{
    use ThrottlesLogins;

    public function __construct(
        private readonly Auth $auth
    ) {
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $locale = $this->auth->user()->locale();

        $this->auth->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.accounts.user.login')->with(['locale' => $locale]);
    }
}
