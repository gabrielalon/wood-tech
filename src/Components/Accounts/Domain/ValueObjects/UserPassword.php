<?php declare(strict_types=1);

namespace Components\Accounts\Domain\ValueObjects;

final class UserPassword
{
    public function __construct(
        private readonly string $value,
    ) {
    }

    public function value(): string
    {
        return $this->value;
    }
}
