<?php declare(strict_types=1);

namespace Components\Accounts\Domain\ValueObjects;

final class AdminDeletedAt
{
    public function __construct(
        private readonly \DateTimeImmutable|null $value = null,
    ) {
    }

    public function value(): \DateTimeImmutable|null
    {
        return $this->value;
    }
}
