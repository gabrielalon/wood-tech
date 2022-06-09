<?php declare(strict_types=1);

namespace Components\Accounts\Adapters\UI\Http\Admin;

use Components\Accounts\Application\Account;
use Illuminate\Http\RedirectResponse;

final class AdminRemoveHandler
{
    public function __construct(
        private readonly Account $account,
    ) {
    }

    public function __invoke(string $adminId): RedirectResponse
    {
        $this->account->removeAdmin($adminId);

        return redirect()->back()->with(['success' => __('form.flash.success')]);
    }
}
