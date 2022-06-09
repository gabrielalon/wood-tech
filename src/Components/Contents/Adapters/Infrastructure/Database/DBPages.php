<?php declare(strict_types=1);

namespace Components\Contents\Adapters\Infrastructure\Database;

use Components\Contents\Adapters\Infrastructure\Entity\Page as PageEntity;
use Components\Contents\Domain\Enum\PageTypeEnum;
use Components\Contents\ReadModel\Model\Page;
use Components\Contents\ReadModel\Ports\Pages;
use System\IdGenerator;
use System\Valuing\Intl\Language\Contents;
use System\Valuing\Intl\Language\Texts;

final class DBPages implements Pages
{
    public function __construct(
        private readonly IdGenerator $idGenerator
    ) {
    }

    public function getPageByType(string $type): Page
    {
        $entity = PageEntity::query()->newModelInstance([
            'type' => $type,
            'id' => $this->idGenerator->id(),
        ]);

        if (($typeEnum = PageTypeEnum::tryFrom($type)) && $row = PageEntity::findByType($typeEnum)) {
            $entity = $row;
        }

        return $this->convert($entity);
    }

    public function getHomePage(): Page
    {
        return $this->getPageByType(PageTypeEnum::HOME->value);
    }

    private function convert(PageEntity $entity): Page
    {
        return new Page(
            $entity->id,
            $entity->type,
            Texts::fromArray($entity->names()),
            Texts::fromArray($entity->leads()),
            Contents::fromArray($entity->descriptions()),
        );
    }
}
