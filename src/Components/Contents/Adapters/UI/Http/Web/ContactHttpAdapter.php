<?php declare(strict_types=1);

namespace Components\Contents\Adapters\UI\Http\Web;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class ContactHttpAdapter
{
    public function __construct(
        private readonly Factory $viewFactory,
    ) {
    }

    public function __invoke(string $locale): View
    {
        return $this->viewFactory->make('web.contact.index', [
            'locale' => $locale,
        ]);
    }
}
