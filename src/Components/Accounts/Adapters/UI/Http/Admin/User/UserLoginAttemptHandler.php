<?php declare(strict_types=1);

namespace Components\Accounts\Adapters\UI\Http\Admin\User;

use System\Illuminate\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use System\Enum\RoleEnum;
use System\Illuminate\Http\WebHandler;

final class UserLoginAttemptHandler extends WebHandler
{
    use ThrottlesLogins;

    public function __construct(
        private readonly Auth $auth
    ) {
    }

    public function __invoke(UserLoginAttemptRequest $request): RedirectResponse
    {
        if (true === $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            $this->sendLockoutResponse($request);
        }

        $auth = $this->auth->withRole(RoleEnum::ADMIN);

        if (false === $auth->login($request->toArray(), $request->filled('remember'))) {
            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            $this->incrementLoginAttempts($request);

            throw ValidationException::withMessages([$request->username() => [trans('auth.failed')]]);
        }

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return redirect()->route('admin.dashboard.index');
    }

    public function username(): string
    {
        return 'email';
    }
}
