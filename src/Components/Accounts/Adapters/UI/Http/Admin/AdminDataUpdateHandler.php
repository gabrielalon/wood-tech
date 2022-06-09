<?php declare(strict_types=1);

namespace Components\Accounts\Adapters\UI\Http\Admin;

use Components\Accounts\Application\Account;
use Illuminate\Http\RedirectResponse;
use System\Illuminate\Http\WebHandler;

final class AdminDataUpdateHandler extends WebHandler
{
    public function __construct(
        private readonly Account $account,
    ) {
    }

    public function __invoke(string $adminId, AdminDataUpdateRequest $request): RedirectResponse
    {
        $this->account->updateAdmin($adminId, $request->fullName());
        $request->locale(); // to do

        flash()->success(__('form.flash.success'));

        return redirect()->back();
    }
}
