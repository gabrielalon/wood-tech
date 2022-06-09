<?php

namespace System\Valuing;

use InvalidArgumentException;

abstract class VO implements Stringify
{
    protected mixed $value;

    public function __construct(mixed $value)
    {
        $this->value = $value;
        $this->guard($value);
    }

    /**
     * @throws InvalidArgumentException
     */
    abstract public function guard(mixed $value): void;

    public function __toString(): string
    {
        return $this->toString();
    }

    public function equals(mixed $other): bool
    {
        if (false === $other instanceof self) {
            return false;
        }

        return $this->value === $other->value;
    }

    public function raw(): mixed
    {
        return $this->value;
    }
}
