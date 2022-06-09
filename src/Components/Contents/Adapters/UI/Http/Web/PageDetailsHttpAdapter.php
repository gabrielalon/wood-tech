<?php declare(strict_types=1);

namespace Components\Contents\Adapters\UI\Http\Web;

use Components\Contents\ReadModel\Ports\Pages;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class PageDetailsHttpAdapter
{
    public function __construct(
        private readonly Pages $pages,
        private readonly Factory $viewFactory,
    ) {
    }

    public function __invoke(string $locale, string $type): View
    {
        return $this->viewFactory->make('web.page.details', [
            'locale' => $locale,
            'page' => $this->pages->getPageByType($type),
        ]);
    }
}
