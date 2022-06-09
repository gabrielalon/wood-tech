<?php

namespace System\Illuminate\Providers;

use Components\Accounts\Adapters\Infrastructure\Database\DoctrineAdminRepository;
use Components\Accounts\Adapters\Infrastructure\Database\DBAdmins;
use Components\Accounts\Adapters\Infrastructure\Database\DBRoles;
use Components\Accounts\Adapters\Infrastructure\Database\DBUserRepository;
use Components\Accounts\Adapters\Infrastructure\Database\DBUsers;
use Components\Accounts\Domain\Persist\AdminRepository;
use Components\Accounts\Domain\Persist\UserRepository;
use Components\Accounts\ReadModel\Ports\Admins;
use Components\Accounts\ReadModel\Ports\Roles;
use Components\Accounts\ReadModel\Ports\Users;
use Components\Contents\Adapters\Infrastructure\Database\DBFaqs;
use Components\Contents\Adapters\Infrastructure\Database\DBOffers;
use Components\Contents\Adapters\Infrastructure\Database\DBPages;
use Components\Contents\Adapters\Infrastructure\Database\DBSnippets;
use Components\Contents\Adapters\UI\Http\Web\ContactHttpAdapter;
use Components\Contents\Adapters\UI\Http\Web\FaqListHttpAdapter;
use Components\Contents\Adapters\View\FooterComponent;
use Components\Contents\Adapters\View\LanguagesComponent;
use Components\Contents\ReadModel\Ports\Faqs;
use Components\Contents\ReadModel\Ports\Offers;
use Components\Contents\ReadModel\Ports\Pages;
use Components\Contents\ReadModel\Ports\Snippets;
use Components\Sites\Adapters\Infrastructure\Database\DBLanguages;
use Components\Sites\ReadModel\Ports\Languages;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Spatie\Flash\Flash;
use Spatie\Menu\Laravel\Facades\Menu;
use Spatie\Menu\Laravel\Link;

final class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        // Accounts
        Roles::class => DBRoles::class,
        Users::class => DBUsers::class,
        Admins::class => DBAdmins::class,
        AdminRepository::class => DoctrineAdminRepository::class,
        UserRepository::class => DBUserRepository::class,

        // Contents
        Faqs::class => DBFaqs::class,
        Offers::class => DBOffers::class,
        Pages::class => DBPages::class,
        Snippets::class => DBSnippets::class,

        // Sites
        Languages::class => DBLanguages::class,
    ];

    public function boot(): void
    {
        Blade::component('contents-languages', LanguagesComponent::class);
        Blade::component('contents-footer', FooterComponent::class);

        Menu::macro('main', function () {
            return Menu::new()
                ->addClass('navbar-nav me-auto mb-2 mb-lg-0')
                ->add(Link::toAction(FaqListHttpAdapter::class, __('menu.faq'))->addClass('nav-link'))
                ->add(Link::toAction(ContactHttpAdapter::class, __('menu.contact'))->addClass('nav-link'))
                ->setActiveFromRequest();
        });

        Flash::levels([
            'success' => 'alert alert-success',
            'warning' => 'alert alert-warning',
            'error' => 'alert alert-error',
            'info' => 'alert alert-info',
        ]);

        Builder::macro('whereLike', function ($attributes, string $searchTerm): Builder {
            /* @phpstan-ignore-next-line */
            assert($this instanceof Builder);
            $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                }
            });

            return $this;
        });

        Builder::macro('orWhereLike', function ($attributes, string $searchTerm): Builder {
            /* @phpstan-ignore-next-line */
            assert($this instanceof Builder);
            $this->orWhere(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                }
            });

            return $this;
        });
    }
}
