<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WebHookController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\{ShoppingCart, CreateOrder, PaymentOrder};

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

Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');

Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('search', SearchController::class)->name('search');

Route::get('shopping-cart', ShoppingCart::class)->name('shopping-cart');

Route::view('errors', 'errors.no-cart-items')->name('errors.no-cart-items');

Route::group(['prefix' => 'orders', 'middleware' => ['auth', 'check-cart']], function() {
    Route::get('create', CreateOrder::class)->name('orders.create');
});

Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');

Route::get('orders/{order}/payment', PaymentOrder::class)->name('orders.payment');

/*Route::get('orders/{order}/payment', [OrderController::class, 'payment'])->name('orders.payment');*/

Route::get('orders/{order}/pay', [OrderController::class, 'pay'])->name('orders.pay');

Route::post('webhooks', WebHookController::class);
