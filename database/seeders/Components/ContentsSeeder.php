<?php

declare(strict_types=1);

namespace Database\Seeders\Components;

use Components\Contents\Adapters\Infrastructure\Entity\Faq;
use Components\Contents\Adapters\Infrastructure\Entity\Offer;
use Components\Contents\Adapters\Infrastructure\Entity\Page;
use Components\Contents\Adapters\Infrastructure\Entity\Snippet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use System\Enum\LocaleEnum;
use System\JsonSerializer;

final class ContentsSeeder extends Seeder
{
    public function run(JsonSerializer $serializer): void
    {
        $this->seedFaqs($serializer);
        $this->seedOffers($serializer);
        $this->seedPages($serializer);
        $this->seedSnippets($serializer);
    }

    private function seedFaqs(JsonSerializer $serializer): void
    {
        Faq::query()->delete();

        $source = database_path('/dump/faqs.json');
        foreach ($serializer->decode(file_get_contents($source)) as $data) {
            /** @var Faq $faq */
            $faq = Faq::query()->create();

            foreach (LocaleEnum::cases() as $locale) {
                $faq->translateOrNew($locale->value)->answer = Arr::get($data[$locale->value], 'answer');
                $faq->translateOrNew($locale->value)->question = Arr::get($data[$locale->value], 'question');
            }

            $faq->save();
        }
    }

    private function seedOffers(JsonSerializer $serializer): void
    {
        $source = database_path('/dump/offers.json');
        foreach ($serializer->decode(file_get_contents($source)) as $data) {
            /** @var Offer $offer */
            $offer = Offer::query()->updateOrCreate(['type' => $data['type']]);

            foreach (LocaleEnum::cases() as $locale) {
                $offer->translateOrNew($locale->value)->name = Arr::get($data[$locale->value], 'name');
                $offer->translateOrNew($locale->value)->lead = Arr::get($data[$locale->value], 'lead');
                $offer->translateOrNew($locale->value)->description = Arr::get($data[$locale->value], 'description');
            }

            $offer->save();
        }
    }

    private function seedPages(JsonSerializer $serializer): void
    {
        $source = database_path('/dump/pages.json');
        foreach ($serializer->decode(file_get_contents($source)) as $data) {
            /** @var Page $page */
            $page = Page::query()->updateOrCreate(['type' => $data['type']]);

            foreach (LocaleEnum::cases() as $locale) {
                $page->translateOrNew($locale->value)->name = Arr::get($data[$locale->value], 'name');
                $page->translateOrNew($locale->value)->lead = Arr::get($data[$locale->value], 'lead');
                $page->translateOrNew($locale->value)->description = Arr::get($data[$locale->value], 'description');
            }

            $page->save();
        }
    }

    private function seedSnippets(JsonSerializer $serializer): void
    {
        $source = database_path('/dump/snippets.json');
        foreach ($serializer->decode(file_get_contents($source)) as $data) {
            /** @var Snippet $snippet */
            $snippet = Snippet::query()->updateOrCreate(['type' => $data['type']]);

            foreach (LocaleEnum::cases() as $locale) {
                $snippet->translateOrNew($locale->value)->value = Arr::get($data[$locale->value], 'value');
            }

            $snippet->save();
        }
    }
}
