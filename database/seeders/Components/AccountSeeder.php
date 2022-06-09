<?php

declare(strict_types=1);

namespace Database\Seeders\Components;

use Components\Accounts\Adapters\Infrastructure\Entity\Role;
use Components\Accounts\Adapters\Infrastructure\Entity\State;
use Illuminate\Database\Seeder;
use System\Enum\LocaleEnum;
use System\Enum\RoleEnum;
use System\Enum\StateEnum;

final class AccountSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedStates();
        $this->seedRoles();
    }

    private function seedStates(): void
    {
        foreach (StateEnum::cases() as $state) {
            $entity = State::query()->updateOrCreate(['type' => $state->value]);

            foreach (LocaleEnum::cases() as $locale) {
                $entity->translateOrNew($locale->value)->name = $state->value;
            }

            $entity->save();
        }
    }

    private function seedRoles(): void
    {
        foreach (RoleEnum::cases() as $role) {
            $entity = Role::query()->updateOrCreate(['type' => $role->value], [
                'level' => 0,
            ]);

            foreach (LocaleEnum::cases() as $locale) {
                $entity->translateOrNew($locale->value)->description = $role->value;
            }

            $entity->save();
        }
    }
}
