<?php declare(strict_types=1);

namespace Components\Contents\Adapters\Infrastructure\Database;

use Components\Contents\Adapters\Infrastructure\Entity\Snippet as SnippetEntity;
use Components\Contents\Domain\Enum\SnippetTypeEnum;
use Components\Contents\ReadModel\Model\Snippet;
use Components\Contents\ReadModel\Ports\Snippets;
use System\Valuing\Intl\Language\Contents;

final class DBSnippets implements Snippets
{
    public function getSnippetByType(string $type): Snippet
    {
        $entity = SnippetEntity::query()->newModelInstance([
            'type' => $type,
        ]);

        if ($typeEnum = SnippetTypeEnum::tryFrom($type)) {
            $entity = SnippetEntity::findByType($typeEnum);
        }

        return $this->convert($entity);
    }

    private function convert(SnippetEntity $entity): Snippet
    {
        return new Snippet(
            $entity->id,
            $entity->type,
            Contents::fromArray($entity->values()),
        );
    }
}
