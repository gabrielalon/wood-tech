<?php declare(strict_types=1);

namespace Components\Contents\Adapters\View;

use Components\Sites\ReadModel\Ports\Languages;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LanguagesComponent extends Component
{
    public function __construct(
        private readonly Languages $languages,
        private readonly Factory $viewFactory,
    ) {
    }

    public function render(): View
    {
        return $this->viewFactory->make('components.languages', [
            'languages' => $this->languages->getActiveLanguages(),
        ]);
    }
}
