<?php

namespace Components\Accounts\Application\Command\RefreshUserLocale;

use System\Enum\LocaleEnum;

final class RefreshUserLocale
{
    public function __construct(
        private readonly string $id,
        private readonly LocaleEnum $locale
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function locale(): LocaleEnum
    {
        return $this->locale;
    }
}
