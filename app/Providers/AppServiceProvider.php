<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach (config('repositories.bindings') as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }

        foreach (config('repositories.singletons') as $interface => $repository) {
            $this->app->singleton($interface, $repository);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
    }
}
