<?php declare(strict_types=1);

namespace Components\Accounts\Adapters\UI\Http\Admin;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use System\Illuminate\Auth;
use System\Illuminate\Http\WebHandler;

final class AdminProfileHandler extends WebHandler
{
    public function __construct(
        private readonly Auth $auth,
        private readonly Factory $viewFactory,
    ) {
    }

    /**
     * @return View
     */
    public function __invoke(): View
    {
        return $this->viewFactory->make('admin.accounts.admin.profile.show')->with([
            'admin' => $this->auth->admin(),
        ]);
    }
}
