<?php

namespace System\Valuing\Intl\Language;

use System\Enum\LocaleEnum;
use System\Valuing\Char\Char;
use ArrayIterator;
use InvalidArgumentException;

final class Collection extends ArrayIterator
{
    public function add(LocaleEnum $locale, Char $text): void
    {
        $this->offsetSet($locale->value, $text);
    }

    public function equals(mixed $other): bool
    {
        if (false === $other instanceof self) {
            return false;
        }

        foreach ($this->getArrayCopy() as $locale => $char) {
            assert($char instanceof Char);

            try {
                $otherValue = $other->get($locale);
            } catch (InvalidArgumentException $e) {
                return false;
            }

            if (false === $char->equals($otherValue)) {
                return false;
            }
        }

        return true;
    }

    public function get(LocaleEnum $locale): Char
    {
        if (false === $this->offsetExists($locale->value)) {
            throw new InvalidArgumentException('Not Found Locale string: '.$locale->value, 500);
        }

        return $this->offsetGet($locale);
    }
}
