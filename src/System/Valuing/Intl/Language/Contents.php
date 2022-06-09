<?php

namespace System\Valuing\Intl\Language;

use System\Enum\LocaleEnum;
use System\Valuing\Char\Content;
use System\Valuing\VO;
use Webmozart\Assert\Assert as Assertion;

/**
 * @property Collection $value
 */
final class Contents extends VO
{
    public static function fromArray(array $data): Contents
    {
        return new self($data);
    }

    public function guard(mixed $value): void
    {
        Assertion::isArray($value, 'Invalid Locales array');

        $this->value = new Collection();

        foreach ($value as $locale => $content) {
            $this->value->add(LocaleEnum::from($locale), Content::fromString($content));
        }
    }

    public function locale(string $locale): Content
    {
        $content = Content::fromString('');

        if (true === $this->value->offsetExists($locale)) {
            $content = $this->value->offsetGet($locale);
        }

        return $content;
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

        foreach ($this->getLocales() as $locale => $content) {
            $data[$locale] = $content->toString();
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
