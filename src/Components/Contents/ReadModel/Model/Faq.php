<?php declare(strict_types=1);

namespace Components\Contents\ReadModel\Model;

use System\Valuing\Intl\Language\Contents;
use System\Valuing\Intl\Language\Texts;

final class Faq
{
    public function __construct(
        public readonly string $id,
        public readonly Texts $questions,
        public readonly Contents $answers,
    ) {
    }
}
