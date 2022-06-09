<?php

namespace Database\Seeders\Components;

use Components\Sites\Adapters\Infrastructure\Entity\Continent;
use Components\Sites\Adapters\Infrastructure\Entity\Country;
use Components\Sites\Adapters\Infrastructure\Entity\Currency;
use Components\Sites\Adapters\Infrastructure\Entity\Language;
use function database_path;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;
use System\Enum\LocaleEnum;
use System\JsonSerializer;

final class SitesSeeder extends Seeder
{
    public function run(JsonSerializer $serializer): void
    {
        foreach (LocaleEnum::cases() as $enum) {
            $this->seedLanguage($enum->value);
        }

        $source = database_path('/dump/continents.json');
        foreach ($serializer->decode(file_get_contents($source)) as $code => $names) {
            $this->seedContinent($code, $names);
        }

        $source = database_path('/dump/countries.json');
        foreach ($serializer->decode(file_get_contents($source)) as $code => $data) {
            $this->seedCountry($code, $data);
        }
    }

    private function seedLanguage(string $code): void
    {
        Language::query()->updateOrCreate(['code' => $code], [
            'native_name' => Str::ucfirst(Languages::getName($code, displayLocale: $code)),
            'is_active' => LocaleEnum::tryFrom($code) instanceof LocaleEnum,
        ]);
    }

    private function seedContinent(string $code, array $names): void
    {
        /** @var Continent $continent */
        $continent = Continent::query()->updateOrCreate(['code' => $code]);

        foreach (LocaleEnum::cases() as $locale) {
            $continent->translateOrNew($locale->value)->name = $names[$locale->value];
        }

        $continent->save();
    }

    private function seedCurrency(string $code): void
    {
        Currency::query()->updateOrCreate(['code' => $code]);
    }

    private function seedCountry(string $code, array $data): void
    {
        /** @var Country $country */
        $country = Country::query()->updateOrCreate(['code' => $code], [
            'continent_code' => $data['continent'],
            'native_name' => $data['native'],
        ]);

        $country->translateOrNew(LocaleEnum::EN->value)->name = $data['name'];
        $country->translateOrNew(LocaleEnum::PL->value)->name = $this->translateCountryToPolish($code, $data['name']);
        $country->save();

        foreach (explode(',', $data['phone']) as $prefix) {
            if (false === $country->phones()->where(['prefix' => $prefix])->exists()) {
                $country->phones()->create(['prefix' => $prefix]);
            }
        }

        foreach ($data['languages'] as $language) {
            $this->seedLanguage($language);
            if (false === $country->languages()->where(['language_code' => $language])->exists()) {
                $country->languages()->create(['language_code' => $language]);
            }
        }

        foreach (explode(',', $data['currency']) as $currency) {
            $this->seedCurrency($currency);
            if (false === $country->currencies()->where(['currency_code' => $currency])->exists()) {
                $country->currencies()->create(['currency_code' => $currency]);
            }
        }
    }

    private function translateCountryToPolish(string $code, string $default): string
    {
        try {
            return Countries::getName($code, LocaleEnum::PL->value);
        } catch (\Exception $exception) {
            return $default;
        }
    }
}
