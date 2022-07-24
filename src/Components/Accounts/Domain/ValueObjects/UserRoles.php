<?php declare(strict_types=1);

namespace Components\Accounts\Domain\ValueObjects;

use System\Enum\RoleEnum;
use Webmozart\Assert\Assert;

final class UserRoles
{
    public function __construct(
        private readonly array $values = [],
    ) {
        array_walk($this->values, static fn ($role) => Assert::notNull(
            RoleEnum::tryFrom($role),
            sprintf('<%s> does not allow the invalid role: <%s>.', __CLASS__, $role)
        ));
    }

    public function values(): array
    {
        return $this->values;
    }
}
