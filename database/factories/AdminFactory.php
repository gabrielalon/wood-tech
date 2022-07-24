<?php

namespace Database\Factories;

use Components\Accounts\Adapters\Infrastructure\ORM\Admin;
use Components\Accounts\Adapters\Infrastructure\ORM\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class AdminFactory extends Factory
{
    /** @var string */
    protected $model = Admin::class;

    public function definition(): array
    {
        $user = User::factory()->create();

        return [
            'id' => $this->faker->uuid,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'user_id' => $user->id,
        ];
    }
}
