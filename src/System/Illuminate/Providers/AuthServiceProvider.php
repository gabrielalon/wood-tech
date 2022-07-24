<?php

namespace System\Illuminate\Providers;

use Components\Accounts\Adapters\Infrastructure\Services\UserAuthProvider;
use Components\Accounts\Application\Service\AuthProvider;
use Components\Accounts\ReadModel\Model\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use System\Enum\PermissionEnum;

final class AuthServiceProvider extends ServiceProvider
{
    public array $bindings = [
        AuthProvider::class => UserAuthProvider::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Auth::provider('users', function () {
            return $this->app->get(AuthProvider::class);
        });

        $permissions = new Collection(PermissionEnum::cases());
        $permissions->each(function (PermissionEnum $ability) {
            Gate::define($ability->value, function (User $user) use ($ability) {
                $userPermissions = new Collection($user->permissions());

                $altPermissions = $this->altPermissions($ability->value);

                return null !== $userPermissions->first(function (string $ident) use ($altPermissions) {
                    return \in_array($ident, $altPermissions, true);
                });
            });
        });
    }

    /**
     * @param string $permission
     *
     * @return string[]
     */
    private function altPermissions(string $permission): array
    {
        $altPermissions = ['*', $permission];
        $permParts = explode('.', $permission);

        $currentPermission = '';
        for ($i = 0; $i < (count($permParts) - 1); ++$i) {
            $currentPermission .= $permParts[$i].'.';
            $altPermissions[] = $currentPermission.'*';
        }

        return $altPermissions;
    }
}
