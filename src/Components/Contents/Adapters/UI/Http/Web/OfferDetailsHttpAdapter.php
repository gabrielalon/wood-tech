<?php declare(strict_types=1);

namespace Components\Contents\Adapters\UI\Http\Web;

use Components\Contents\ReadModel\Ports\Offers;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class OfferDetailsHttpAdapter
{
    public function __construct(
        private readonly Offers $offers,
        private readonly Factory $viewFactory,
    ) {
    }

    public function __invoke(string $locale, string $id): View
    {
        return $this->viewFactory->make('web.offer.details', [
            'locale' => $locale,
            'offer' => $this->offers->findOffer($id),
        ]);
    }
}
