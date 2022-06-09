<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Utils\Assembler;

use Components\Accounts\Application\Command\RemoveAdmin\RemoveAdmin;

final class RemoveAdminAssembler
{
    public function __construct(
        private string $id,
    ) {
    }

    public static function new(): self
    {
        return new self('867d4ec5-f8a8-48e1-beb6-a287b7d11ca6');
    }

    public function withId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function assemble(): RemoveAdmin
    {
        return new RemoveAdmin($this->id);
    }
}
