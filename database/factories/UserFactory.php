<?php

namespace Database\Factories;

use Components\Accounts\Adapters\Infrastructure\ORM\State;
use Components\Accounts\Adapters\Infrastructure\ORM\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use System\Enum\LocaleEnum;
use System\Enum\StateEnum;

/**
 * @method static UserFactory new(array $attributes = [])
 * @method User createOne($attributes = [])
 */
final class UserFactory extends Factory
{
    /** @var string */
    protected $model = User::class;

    public function definition(): array
    {
        $email = $this->faker->unique()->safeEmail;

        return [
            'id' => $this->faker->uuid,
            'state_id' => State::getOrCreateByType(StateEnum::INACTIVE)->id,
            'login' => $email,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => Hash::make($this->faker->password),
            'remember_token' => Str::random(10),
            'locale' => LocaleEnum::PL->value,
        ];
    }
}
