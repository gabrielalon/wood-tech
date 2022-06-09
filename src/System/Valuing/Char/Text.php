<?php

namespace System\Valuing\Char;

use System\Valuing\VO;
use Webmozart\Assert\Assert as Assertion;

final class Text extends VO implements Char
{
    public static function fromString(string $text): Text
    {
        return new self($text);
    }

    public function guard(mixed $value): void
    {
        Assertion::string($value, 'Invalid Text string: '.$value);
        Assertion::maxLength(
            $value,
            $this->maxLength(),
            sprintf('Invalid Text string length (%d)', $this->maxLength())
        );
    }

    private function maxLength(): int
    {
        return 2 ** 8;
    }

    public function toString(): string
    {
        return (string) $this->value;
    }
}
