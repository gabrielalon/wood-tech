<?php

namespace System\Valuing\Intl\Language;

use System\Enum\LocaleEnum;
use System\Valuing\Char\Text;
use System\Valuing\VO;
use InvalidArgumentException;
use Webmozart\Assert\Assert as Assertion;

/**
 * @property Collection $value
 */
final class Texts extends VO
{
    public static function fromArray(array $data): Texts
    {
        return new self($data);
    }

    public function guard(mixed $value): void
    {
        Assertion::isArray($value, 'Invalid Locales array');

        $this->value = new Collection();

        foreach ($value as $locale => $text) {
            $this->value->add(LocaleEnum::from($locale), Text::fromString($text));
        }
    }

    public function locale(string $locale): Text
    {
        $text = Text::fromString('');

        if (true === $this->value->offsetExists($locale)) {
            $text = $this->value->offsetGet($locale);
        }

        return $text;
    }

    public function equals(mixed $other): bool
    {
        if (false === $other instanceof self) {
            return false;
        }

        return $this->value->equals($other->value);
    }

    public function raw(): array
    {
        $data = [];

        foreach ($this->getLocales() as $locale => $text) {
            $data[$locale] = $text->toString();
        }

        return $data;
    }

    public function getLocales(): array
    {
        return $this->value->getArrayCopy();
    }

    public function toString(): string
    {
        return json_encode($this->raw(), JSON_THROW_ON_ERROR);
    }
}
