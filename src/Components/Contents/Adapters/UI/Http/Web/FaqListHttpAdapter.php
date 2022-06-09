<?php declare(strict_types=1);

namespace Components\Contents\Adapters\UI\Http\Web;

use Components\Contents\ReadModel\Ports\Faqs;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class FaqListHttpAdapter
{
    public function __construct(
        private readonly Faqs $faqs,
        private readonly Factory $viewFactory,
    ) {
    }

    public function __invoke(string $locale): View
    {
        return $this->viewFactory->make('web.faq.list', [
            'locale' => $locale,
            'faqs' => $this->faqs->getFaqs(),
        ]);
    }
}
