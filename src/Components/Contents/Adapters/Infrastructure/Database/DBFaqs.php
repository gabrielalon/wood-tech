<?php declare(strict_types=1);

namespace Components\Contents\Adapters\Infrastructure\Database;

use Components\Contents\Adapters\Infrastructure\Entity\Faq as FaqEntity;
use Components\Contents\ReadModel\Model\Faq;
use Components\Contents\ReadModel\Ports\Faqs;
use System\Valuing\Intl\Language\Contents;
use System\Valuing\Intl\Language\Texts;

final class DBFaqs implements Faqs
{
    public function getFaqs(): array
    {
        return FaqEntity::query()->get()
            ->map(fn (FaqEntity $entity): Faq => $this->convert($entity))
            ->all();
    }

    private function convert(FaqEntity $entity): Faq
    {
        return new Faq(
            $entity->id,
            Texts::fromArray($entity->questions()),
            Contents::fromArray($entity->answers()),
        );
    }
}
