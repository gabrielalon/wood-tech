<?php declare(strict_types=1);

namespace Components\Accounts\Domain\ValueObjects;

use System\Enum\LocaleEnum;
use Webmozart\Assert\Assert;

final class UserLocale
{
    public function __construct(
        private readonly string $value,
    ) {
        Assert::notNull(
            LocaleEnum::tryFrom($this->value),
            sprintf('<%s> does not allow the invalid locale: <%s>.', __CLASS__, $this->value)
        );
    }

    public function value(): string
    {
        return $this->value;
    }
}
