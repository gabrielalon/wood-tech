<?php

namespace Components\Contents\Adapters\UI\Http\Admin\Index;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class DashboardHttpAdapter
{
    public function __construct(
        private readonly Factory $viewFactory,
    ) {
    }

    public function __invoke(): View
    {
        return $this->viewFactory->make('admin.dashboard.index');
    }
}
