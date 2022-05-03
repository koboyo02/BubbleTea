<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserAddressController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home.index');
});

<<<<<<< HEAD
Route::get('/produit', function () {
    return view('add');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::get('/test', [TestController::class, 'index'])->name('test');

=======
>>>>>>> 151cddc502ed11557387cda401749f2b0ac65e99
require __DIR__.'/auth.php';

require __DIR__.'/admin.php';

Route::group(['prefix' => 'cart'], function () {
    Route::get('/', [CartController::class, 'index'])
        ->name('cart.index')
    ;

    Route::post('/add-item/{productId}', [CartController::class, 'addItem'])
        ->where('productId', '[0-9]+')
        ->name('cart.add_item')
    ;

    Route::post('/add-item-supplement', [CartController::class, 'addItemSupplement'])
        ->name('cart.add_item_supplement')
    ;

    Route::post('/set-item-quantity/{orderItemId}', [CartController::class, 'setItemQuantity'])
        ->name('cart.set_item_quantity')
    ;

    Route::post('/remove-item/{orderItemId}', [CartController::class, 'removeItem'])
        ->name('cart.remove_item')
    ;

    Route::post('/checkout', [CartController::class, 'checkout'])
        ->middleware(['auth'])
        ->name('cart.checkout')
    ;

    Route::match(['get', 'post'], '/payment', [CartController::class, 'payment'])
        ->middleware(['auth'])
        ->name('cart.payment')
    ;
});

Route::group(['prefix' => 'account', 'middlewares' => ['auth']], function () {
    Route::get('/', [AccountController::class, 'index'])
        ->name('account.index')
    ;

    Route::group(['prefix' => 'addresses'], function () {
        Route::get('/', [UserAddressController::class, 'index'])
            ->name('account.addresses.index')
            ->middleware(['auth'])
        ;

        Route::match(['get', 'post'], '/create', [UserAddressController::class, 'create'])
            ->name('account.addresses.create')
            ->middleware(['auth'])
        ;
        Route::match(['get', 'post'], '/{id}/edit', [UserAddressController::class, 'edit'])
            ->where('id', '[0-9]+')
            ->name('account.addresses.edit')
            ->middleware(['auth'])
        ;
        Route::post('/{id}/delete', [UserAddressController::class, 'delete'])
            ->where('id', '[0-9]+')
            ->name('account.addresses.delete')
        ;
    });
});
