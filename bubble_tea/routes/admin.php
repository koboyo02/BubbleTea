<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SupplementController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', ['middlewares' => ['auth', 'admin']]], function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('admin.dashboard.index')
    ;

    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [ProductController::class, 'index'])
            ->name('admin.products.index')
            ->middleware(['auth'])
        ;

        Route::match(['get', 'post'], '/create', [ProductController::class, 'create'])
            ->name('admin.products.create')
            ->middleware(['auth'])
        ;
        Route::match(['get', 'post'], '/{id}/edit', [ProductController::class, 'edit'])
            ->where('id', '[0-9]+')
            ->name('admin.products.edit')
            ->middleware(['auth'])
        ;
        Route::match(['get', 'post'], '/{id}/delete', [ProductController::class, 'delete'])
            ->where('id', '[0-9]+')
            ->name('admin.products.delete')
        ;
    });

    Route::group(['prefix' => 'supplements'], function () {
        Route::get('/', [SupplementController::class, 'index'])
            ->name('admin.supplements.index')
            ->middleware(['auth'])
        ;

        Route::match(['get', 'post'], '/create', [SupplementController::class, 'create'])
            ->name('admin.supplements.create')
            ->middleware(['auth'])
        ;
        Route::match(['get', 'post'], '/{id}/edit', [SupplementController::class, 'edit'])
            ->where('id', '[0-9]+')
            ->name('admin.supplements.edit')
            ->middleware(['auth'])
        ;
        Route::match(['get', 'post'], '/{id}/delete', [SupplementController::class, 'delete'])
            ->where('id', '[0-9]+')
            ->name('admin.supplements.delete')
        ;
    });
});
