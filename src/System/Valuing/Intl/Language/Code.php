<?php

namespace System\Valuing\Intl\Language;

use System\Valuing\VO;
use Symfony\Component\Intl\Languages;
use Webmozart\Assert\Assert as Assertion;

final class Code extends VO
{
    public static function fromCode(string $code): Code
    {
        return new self($code);
    }

    public function guard(mixed $value): void
    {
        Assertion::regex($value, '/[a-zA-Z]{2}/', 'Invalid Code string: '.$value);
        Assertion::keyExists(Languages::getNames(), $value, 'Invalid Code string: '.$value);
    }

    public function toString(): string
    {
        return (string) $this->value;
    }
}
