<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;


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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product}', [ShopController::class, 'show'])->name('shop.show');

/*Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');*/

Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/{product}', [CartController::class, 'store'])->name('cart.store');
Route::post('update-cart/{product}', [CartController::class, 'update'])->name('cart.update');
Route::post('remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('cart-clear', [CartController::class, 'clear'])->name('cart.clear');

Route::post('/coupon', [CouponController::class, 'store'])->name('coupon.store');
Route::post('/coupon-clear', [CouponController::class, 'clear'])->name('coupon.clear');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index')->middleware('auth');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/confirmation', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
