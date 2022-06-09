<?php declare(strict_types=1);

namespace Components\Accounts\Adapters\UI\Http\Admin\User;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use System\Illuminate\Http\WebHandler;

final class UserLoginHandler extends WebHandler
{
    public function __construct(
        private readonly Factory $viewFactory
    ) {
    }

    /**
     * @return View
     */
    public function __invoke(): View
    {
        return $this->viewFactory->make('admin.accounts.user.login');
    }
}
