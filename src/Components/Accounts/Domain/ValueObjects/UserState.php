<?php declare(strict_types=1);

namespace Components\Accounts\Domain\ValueObjects;

use System\Enum\StateEnum;
use Webmozart\Assert\Assert;

final class UserState
{
    public function __construct(
        private readonly string $value,
    ) {
        Assert::notNull(
            StateEnum::tryFrom($this->value),
            sprintf('<%s> does not allow the invalid state: <%s>.', __CLASS__, $this->value)
        );
    }

    public function value(): string
    {
        return $this->value;
    }
}
