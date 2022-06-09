<?php declare(strict_types=1);

namespace Components\Contents\Adapters\UI\Http\Web;

use Components\Contents\ReadModel\Ports\Offers;
use Components\Contents\ReadModel\Ports\Pages;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class IndexHttpAdapter
{
    public function __construct(
        private readonly Pages $pages,
        private readonly Offers $offers,
        private readonly Factory $viewFactory,
    ) {
    }

    public function __invoke(string $locale): View
    {
        return $this->viewFactory->make('web.home.index', [
            'locale' => $locale,
            'page' => $this->pages->getHomePage(),
            'offers' => $this->offers->getOffers(),
        ]);
    }
}
