<?php

namespace Components\Sites\Adapters\Infrastructure\Database;

use Components\Sites\Adapters\Infrastructure\Entity\Language as LanguageEntity;
use Components\Sites\ReadModel\Model\Language;
use Components\Sites\ReadModel\Ports\Languages;

final class DBLanguages implements Languages
{
    public function getActiveLanguages(): array
    {
        return LanguageEntity::active()->get()
            ->map(fn (LanguageEntity $entity): Language => new Language(
                $entity->code,
                $entity->native_name,
            ))
            ->all();
    }
}
