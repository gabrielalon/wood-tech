<?php

namespace System\Valuing\Char;

use System\Valuing\VO;
use Webmozart\Assert\Assert as Assertion;

final class Content extends VO implements Char
{
    public static function fromString(string $content): Content
    {
        return new self($content);
    }

    public function guard(mixed $value): void
    {
        Assertion::string($value, 'Invalid Content string: '.$value);
        Assertion::maxLength(
            $value,
            $this->maxLength(),
            sprintf('Invalid Content string length (%d)', $this->maxLength())
        );
    }

    private function maxLength(): int
    {
        return 2 ** 32;
    }

    public function toString(): string
    {
        return (string) $this->value;
    }
}
