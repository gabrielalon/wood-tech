<?php

namespace Components\Accounts\Adapters\Validation\Rules;

use Components\Accounts\ReadModel\Ports\Admins;
use Illuminate\Contracts\Validation\ImplicitRule;
use System\Illuminate\Rules\Rule;

final class AdminExists extends Rule implements ImplicitRule
{
    public function __construct(
        private readonly Admins $admins
    ) {
    }

    public static function prepare(): AdminExists
    {
        return new self(app()->make(Admins::class));
    }

    public function passes($attribute, $value): bool
    {
        return $this->admins->existsAdminByEmail($value);
    }

    /**
     * {@inheritDoc}
     */
    public function message(): string
    {
        return $this->getLocalizedErrorMessage(
            'email',
            'The :attribute not exist'
        );
    }
}
