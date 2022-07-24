<?php declare(strict_types=1);

namespace Components\Accounts\Domain\ValueObjects;

final class UserRememberToken
{
    public function __construct(
        private readonly string|null $value = null,
    ) {
    }

    public function value(): ?string
    {
        return $this->value;
    }
}
