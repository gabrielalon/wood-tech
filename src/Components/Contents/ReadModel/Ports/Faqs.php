<?php declare(strict_types=1);

namespace Components\Contents\ReadModel\Ports;

use Components\Contents\ReadModel\Model\Faq;

interface Faqs
{
    /**
     * @return array<Faq>
     */
    public function getFaqs(): array;
}
