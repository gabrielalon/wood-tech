<?php

use Components\Accounts\Adapters\UI\Http\Admin\AdminDataShowHandler;
use Components\Accounts\Adapters\UI\Http\Admin\AdminDataUpdateHandler;
use Components\Accounts\Adapters\UI\Http\Admin\AdminPaginatedListHandler;
use Components\Accounts\Adapters\UI\Http\Admin\AdminPasswordResetHandler;
use Components\Accounts\Adapters\UI\Http\Admin\AdminPasswordResetShowHandler;
use Components\Accounts\Adapters\UI\Http\Admin\AdminProfileHandler;
use Components\Accounts\Adapters\UI\Http\Admin\AdminProfileShowHandler;
use Components\Accounts\Adapters\UI\Http\Admin\AdminRemoveHandler;
use Components\Accounts\Adapters\UI\Http\Admin\User\UserLoginAttemptHandler;
use Components\Accounts\Adapters\UI\Http\Admin\User\UserLoginHandler;
use Components\Accounts\Adapters\UI\Http\Admin\User\UserLogoutHandler;
use Components\Contents\Adapters\UI\Http\Admin\Index\DashboardHttpAdapter;
use Components\Contents\Adapters\UI\Http\Admin\Offer\OfferPaginatedListHttpAdapter;
use Components\Contents\Adapters\UI\Http\Web\ContactHttpAdapter;
use Components\Contents\Adapters\UI\Http\Web\FaqListHttpAdapter;
use Components\Contents\Adapters\UI\Http\Web\IndexHttpAdapter;
use Components\Contents\Adapters\UI\Http\Web\OfferDetailsHttpAdapter;
use Components\Contents\Adapters\UI\Http\Web\PageDetailsHttpAdapter;
use Illuminate\Support\Facades\Route;
use Ramsey\Uuid\Validator\GenericValidator;
use System\Enum\LocaleEnum;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::pattern('locale', LocaleEnum::toString('|'));
Route::pattern('type', '[A-Za-z_]+');
Route::pattern('id', (new GenericValidator())->getPattern());
Route::pattern('adminId', (new GenericValidator())->getPattern());

Route::redirect('/', '/' . locale()->current(), 301);
Route::redirect('/admin', '/admin/accounts/user/login', 301);

Route::prefix('{locale}')->group(function () {
    Route::get('/', IndexHttpAdapter::class)->name('web.contents.index');
    Route::get('/web/contents/home', IndexHttpAdapter::class)->name('web.contents.home');
    Route::get('/web/contents/contact', ContactHttpAdapter::class)->name('web.contents.contact');
    Route::get('/web/contents/faq/list', FaqListHttpAdapter::class)->name('web.contents.faq.list');
    Route::get('/web/contents/pages/details/{type}', PageDetailsHttpAdapter::class)->name('web.contents.pages.details');
    Route::get('/web/contents/offers/details/{id}', OfferDetailsHttpAdapter::class)->name('web.contents.offers.details');
});

Route::prefix('admin')->middleware('web')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/accounts/user/login', UserLoginHandler::class)->name('admin.accounts.user.login');
        Route::post('/accounts/user/login', UserLoginAttemptHandler::class)->name('admin.accounts.user.login.attempt');
        Route::post('/accounts/user/logout', UserLogoutHandler::class)->name('admin.accounts.user.logout');
    });

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/', DashboardHttpAdapter::class)->name('admin.dashboard.index');
        Route::get('/dashboard/index', DashboardHttpAdapter::class)->name('admin.dashboard.home');

        Route::get('/accounts/admin/profile', AdminProfileHandler::class)->name('admin.accounts.admin.profile');
        Route::get('/accounts/admin/list', AdminPaginatedListHandler::class)->name('admin.accounts.admin.list');
        Route::get('/accounts/admin/{adminId}/profile', AdminProfileShowHandler::class)->name('admin.accounts.admin.profile.show');
        Route::get('/accounts/admin/{adminId}/data/form', AdminDataShowHandler::class)->name('admin.accounts.admin.data.show');
        Route::post('/accounts/admin/{adminId}/data/form', AdminDataUpdateHandler::class)->name('admin.accounts.admin.data.update');
        Route::get('/accounts/admin/{adminId}/password/reset/form', AdminPasswordResetShowHandler::class)->name('admin.accounts.admin.password.reset.show');
        Route::post('/accounts/admin/{adminId}/password/reset/form', AdminPasswordResetHandler::class)->name('admin.accounts.admin.password.reset');
        Route::delete('/accounts/admin/{adminId}', AdminRemoveHandler::class)->name('admin.accounts.admin.remove');

        Route::get('/contents/offer/list', OfferPaginatedListHttpAdapter::class)->name('admin.contents.offer.list');
        Route::get('/contents/offer/create/{locale}/form', OfferPaginatedListHttpAdapter::class)->name('admin.contents.offer.new');
        Route::post('/contents/offer/create/{locale}/form', OfferPaginatedListHttpAdapter::class)->name('admin.contents.offer.create');
        Route::get('/contents/offer/{offerId}/edit/{locale}/form', OfferPaginatedListHttpAdapter::class)->name('admin.contents.offer.edit');
        Route::post('/contents/offer/{offerId}/edit/{locale}/form', OfferPaginatedListHttpAdapter::class)->name('admin.contents.offer.update');
        Route::delete('/contents/offer/{offerId}', OfferPaginatedListHttpAdapter::class)->name('admin.contents.offer.remove');
    });
});
