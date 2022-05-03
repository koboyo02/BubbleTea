<?php

namespace App\Providers;

use App\Services\Shop\Order\Storage\OrderSessionStorage;
use App\Services\Shop\Order\Storage\OrderStorageInterface;
use Illuminate\Support\ServiceProvider;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(OrderStorageInterface::class, OrderSessionStorage::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
    }
}
