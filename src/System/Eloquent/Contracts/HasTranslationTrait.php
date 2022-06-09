<?php declare(strict_types=1);

namespace System\Eloquent\Contracts;

use Astrotomic\Translatable\Translatable;
use System\Enum\LocaleEnum;

trait HasTranslationTrait
{
    use Translatable;

    public function translationsArray(string $field): array
    {
        $data = [];

        foreach (LocaleEnum::cases() as $locale) {
            $data[$locale->value] = $this->getTranslationsArray()[$locale->value][$field] ?? '';
        }

        return $data;
    }
}
