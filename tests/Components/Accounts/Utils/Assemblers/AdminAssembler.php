<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Utils\Assemblers;

use Components\Accounts\ReadModel\Model\Admin;
use System\Enum\LocaleEnum;
use System\Enum\RoleEnum;

final class AdminAssembler
{
    public function __construct(
        private readonly string $id,
        private readonly string $locale,
        private readonly string $userId,
        private readonly string $login,
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly ?string $email,
        private readonly array $roles,
    ) {
    }

    public static function new(): self
    {
        return new self(
            '8bbdd980-50db-423e-b9f6-a0870d1e73c8',
            LocaleEnum::EN->value,
            'e2103463-10e4-4167-bd2f-a0827dff4288',
            'john-doe',
            'John',
            'Doe',
            'john@doe.com',
            [RoleEnum::ADMIN->value],
        );
    }

    public function assemble(): Admin
    {
        return new Admin(
            $this->id,
            $this->locale,
            $this->userId,
            $this->login,
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->roles,
        );
    }
}
