<?php

declare(strict_types=1);

namespace Tests\Components\Accounts\Feature\Http;

use Tests\TestCase;

final class UserLoginHandlerTest extends TestCase
{
    /**
     * @test
     */
    public function shouldViewLoginPage(): void
    {
        $response = $this->get(route('admin.accounts.user.login'));
        $response->assertSuccessful();
        $response->assertViewIs('admin.accounts.user.login');
    }
}
