<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\BookController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;

/*
|--------------------------------------------------------------------------
| Public Routes (Guest & Umum)
|--------------------------------------------------------------------------
*/


// Seaech fiture

Route::get('/api/search', [SearchController::class, 'apiSearch'])->name('api.search');
Route::get('/search/results', [SearchController::class, 'showResults'])->name('search.results');




// Book Detail
Route::get('/book/{slug}', [BookController::class, 'show'])
    ->name('book.show');


// Bookmark
Route::post('/bookmark/toggle', [BookmarkController::class, 'toggle'])
    ->middleware('auth')
    ->name('bookmark.toggle');

// Cart
Route::controller(CartController::class)->middleware('auth')->group(function () {
    Route::get('/cart', 'index')->name('cart.index');
    Route::post('/cart/add', 'addToCart')->name('cart.add');
    Route::patch('/cart/update', 'updateQty')->name('cart.update');
    Route::post('/cart/apply-voucher', 'applyVoucher')->name('cart.apply_voucher');
    Route::delete('/cart/{id}', 'destroy')->name('cart.destroy');
});

// Checkout
Route::controller(CheckoutController::class)->middleware('auth')->group(function () {
    Route::get('/checkout', 'index')->name('checkout.index');
    Route::post('/checkout/process', 'process')->name('checkout.process');
});

Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index')->middleware('auth');

Route::get('/bookmark', [BookmarkController::class, 'index'])
    ->middleware('auth')
    ->name('bookmark.index');

Route::get('/events', [App\Http\Controllers\Frontend\EventController::class, 'index'])->name('events.index');
Route::post('/events/{id}/claim', [App\Http\Controllers\Frontend\EventController::class, 'claimVoucher'])->middleware('auth')->name('events.claim');
Route::get('/my-vouchers', [App\Http\Controllers\Frontend\VoucherController::class, 'index'])->middleware('auth')->name('vouchers.index');



// Landing Page
Route::view('/', 'welcome')->name('home');


// Category Landing (Atomic Page)
Route::get('/category', [CategoryController::class, 'index'])
    ->name('category.index');

// Category Detail
Route::get('/category/{slug}', [CategoryController::class, 'show'])
    ->name('category.show');


// Social Auth (Guest Only)
Route::middleware('guest')->controller(SocialAuthController::class)->group(function () {
    Route::get('/auth/google', 'redirect')->name('auth.google');
    Route::get('/auth/google/callback', 'callback');

    Route::get('/auth/github', 'redirectGithub')->name('auth.github');
    Route::get('/auth/github/callback', 'callbackGithub');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // User Dashboard / Jelajah
    Route::get('/jelajah', [BookController::class, 'index'])
        ->name('jelajah');

    // Alias dashboard (anti error Socialite / default Laravel)
    Route::redirect('/dashboard', '/jelajah')->name('dashboard');

    // Profile
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', RoleMiddleware::class . ':admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');
    });

/*
|--------------------------------------------------------------------------
| Auth Scaffolding (Laravel Breeze / Jetstream)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
