<?php

namespace Components\Accounts\Application\Command\RefreshUserLocale;

final class RefreshUserLocale
{
    public function __construct(
        private readonly string $id,
        private readonly string $locale
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function locale(): string
    {
        return $this->locale;
    }
}
