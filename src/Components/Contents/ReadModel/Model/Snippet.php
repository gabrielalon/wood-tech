<?php declare(strict_types=1);

namespace Components\Contents\ReadModel\Model;

use System\Valuing\Intl\Language\Contents;

final class Snippet
{
    public function __construct(
        public readonly string $id,
        public readonly string $type,
        public readonly Contents $values,
    ) {
    }
}
