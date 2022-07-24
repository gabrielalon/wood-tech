<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Feature\Http;

use Symfony\Component\HttpFoundation\Response;
use Tests\Components\Accounts\Utils\Assemblers\UserAssembler;
use Tests\Components\Accounts\Utils\Assemblers\UserLoginAttemptRequestAssembler;
use Tests\Components\Accounts\Utils\Seeders\AdminsSeeder;
use Tests\TestCase;

final class UserLoginAttemptHandlerTest extends TestCase
{
    /**
     * @test
     */
    public function shouldLoginAsAdmin(): void
    {
        $admin = AdminsSeeder::seedOne([
            'email' => $email = 'test@test.com',
            'password' => $password = 'P@ssw0rd',
        ]);

        $response = $this->post(route('admin.accounts.user.login.attempt'), [
            'email' => $email,
            'password' => $password,
        ]);

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertAuthenticatedAs(UserAssembler::new()->fromEntity($admin->user)->assemble());
    }

    /**
     * @test
     * @dataProvider provideBadRequests
     */
    public function shouldFailRequestValidation(array $payload, array $errors): void
    {
        $response = $this->post(route('admin.accounts.user.login.attempt'), $payload);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors($errors);
    }

    public function provideBadRequests(): array
    {
        return [
            'missing email' => [
                UserLoginAttemptRequestAssembler::new()->withEmail(null)->assemble(),
                ['email' => 'Pole email jest wymagane.'],
            ],
            'invalid email' => [
                UserLoginAttemptRequestAssembler::new()->withEmail('test')->assemble(),
                ['email' => 'Pole email nie jest poprawnym adresem e-mail.'],
            ],
            'missing password' => [
                UserLoginAttemptRequestAssembler::new()->withPassword(null)->assemble(),
                ['password' => 'Pole hasło jest wymagane.'],
            ],
            'invalid password' => [
                UserLoginAttemptRequestAssembler::new()->withPassword(124)->assemble(),
                ['password' => 'Pole hasło musi być ciągiem znaków.'],
            ],
        ];
    }
}
