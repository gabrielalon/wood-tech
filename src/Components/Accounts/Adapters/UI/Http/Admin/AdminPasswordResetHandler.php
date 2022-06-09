<?php declare(strict_types=1);

namespace Components\Accounts\Adapters\UI\Http\Admin;

use Components\Accounts\Application\Account;
use Components\Accounts\ReadModel\Ports\Admins;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Http\RedirectResponse;
use System\Illuminate\Auth;
use System\Illuminate\Http\WebHandler;

final class AdminPasswordResetHandler extends WebHandler
{
    public function __construct(
        private readonly Auth $auth,
        private readonly Admins $admins,
        private readonly Account $account,
    ) {
    }

    public function __invoke(string $adminId, AdminPasswordResetRequest $request): RedirectResponse
    {
        $admin = $this->admins->getAdminById($adminId);

        $this->account->changeUserPassword($admin->userId(), $request->password());

        if ($this->auth->user()?->id() === $admin->userId()) {
            $this->auth->reload();
        }

        flash()->success(trans(PasswordBroker::PASSWORD_RESET));

        return redirect()->back();
    }
}
