<?php declare(strict_types=1);

namespace Components\Accounts\Domain\ValueObjects;

use Webmozart\Assert\Assert;

final class AdminId
{
    public function __construct(
        private readonly string $value,
    ) {
        Assert::uuid(
            $this->value,
            sprintf('<%s> does not allow the invalid id: <%s>.', __CLASS__, $this->value)
        );
    }

    public function value(): string
    {
        return $this->value;
    }
}
