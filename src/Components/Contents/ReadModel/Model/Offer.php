<?php declare(strict_types=1);

namespace Components\Contents\ReadModel\Model;

use System\Valuing\Intl\Language\Contents;
use System\Valuing\Intl\Language\Texts;

final class Offer
{
    public function __construct(
        public readonly string $id,
        public readonly string $type,
        public readonly Texts $names,
        public readonly Texts $leads,
        public readonly Contents $descriptions,
    ) {
    }
}
