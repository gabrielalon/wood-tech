<?php declare(strict_types=1);

namespace Components\Contents\Adapters\View;

use Components\Contents\ReadModel\Ports\Offers;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FooterComponent extends Component
{
    public function __construct(
        private readonly Offers $offers,
        private readonly Factory $viewFactory,
    ) {
    }

    public function render(): View
    {
        return $this->viewFactory->make('components.footer', [
            'offers' => $this->offers->getOffers(),
        ]);
    }
}
