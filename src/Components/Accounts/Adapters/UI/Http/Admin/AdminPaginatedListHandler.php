<?php declare(strict_types=1);

namespace Components\Accounts\Adapters\UI\Http\Admin;

use Components\Accounts\ReadModel\Ports\Admins;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Pagination\LengthAwarePaginator;
use System\Illuminate\Http\WebHandler;

final class AdminPaginatedListHandler extends WebHandler
{
    public function __construct(
        private readonly Admins $admins,
        private readonly Factory $viewFactory,
    ) {
    }

    public function __invoke(AdminPaginatedListRequest $request): Renderable
    {
        $adminsPaginated = $this->admins->getAdminsPaginated($request->start(), $request->length(), [
            'path' => route('admin.accounts.admin.list', ['length' => $request->length(), 'filter' => $request->filter()]),
            'filter' => $request->filter(),
        ]);

        return $this->viewFactory->make('admin.accounts.admin.list')->with([
            'filter' => $request->filter(),
            'admins_paginator' => new LengthAwarePaginator(
                $adminsPaginated->admins,
                $adminsPaginated->total,
                $adminsPaginated->perPage,
                $adminsPaginated->currentPage,
                $adminsPaginated->options,
            ),
        ]);
    }
}
