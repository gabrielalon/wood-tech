<?php declare(strict_types=1);

namespace Components\Contents\Application\Command;

final class CreateOffice
{
    public function __construct(
        private readonly string $name,
        private readonly string $lead,
        private readonly string $description,
    ) {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function lead(): string
    {
        return $this->lead;
    }

    public function description(): string
    {
        return $this->description;
    }
}
