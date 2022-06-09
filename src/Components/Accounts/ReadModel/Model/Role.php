<?php

namespace Components\Accounts\ReadModel\Model;

use System\Enum\RoleEnum;
use System\Valuing\Intl\Language\Texts;

final class Role
{
    public function __construct(
        private string $id,
        private RoleEnum $role,
        private Texts $descriptions,
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function type(): string
    {
        return $this->role->value;
    }

    public function description(string $locale): string
    {
        return $this->descriptions->locale($locale)->toString();
    }
}
