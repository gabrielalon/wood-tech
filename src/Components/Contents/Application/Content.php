<?php declare(strict_types=1);

namespace Components\Contents\Application;

use Components\Contents\ReadModel\Model\Page;
use Components\Contents\ReadModel\Ports\Pages;
use Components\Contents\ReadModel\Ports\Snippets;
use System\Illuminate\Locale;

final class Content
{
    public function __construct(
        private readonly Locale $locale,
        private readonly Pages $pages,
        private readonly Snippets $snippets,
    ) {
    }

    public function snippet(string $type, string $locale = null): string
    {
        return $this->snippets
            ->getSnippetByType($type)
            ->values
            ->locale($locale ?? $this->locale->current())
            ->toString();
    }

    public function page(string $type): Page
    {
        return $this->pages->getPageByType($type);
    }
}
