<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // User
        $this->app->bind(
            \App\Repository\Interfaces\UserRepositoryInterface::class,
            \App\Repository\Eloquent\UserRepository::class
        );

        // Todo
        $this->app->bind(
            \App\Repository\Interfaces\TodoRepositoryInterface::class,
            \App\Repository\Eloquent\TodoRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
