<?php declare(strict_types=1);

namespace Components\Accounts\Adapters\UI\Http\Admin;

use Components\Accounts\ReadModel\Ports\Admins;
use Components\Accounts\ReadModel\Ports\Roles;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use System\Illuminate\Http\WebHandler;

final class AdminDataShowHandler extends WebHandler
{
    public function __construct(
        private readonly Roles $roles,
        private readonly Admins $admins,
        private readonly Factory $viewFactory,
    ) {
    }

    public function __invoke(string $adminId): View
    {
        $admin = $this->admins->getAdminById($adminId);

        return $this->viewFactory->make('admin.accounts.admin.profile.data-update')->with([
            'admin' => $admin,
            'roles' => $this->roles->getRoles(),
            'supported_languages' => locale()->getConfiguredSupportedLocales(),
        ]);
    }
}
