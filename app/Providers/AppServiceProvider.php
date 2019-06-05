<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PasswordResetRepository::class, \App\Repositories\PasswordResetRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EventRepositoryEloquent::class, \App\Repositories\EventRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MessageRepositoryEloquent::class, \App\Repositories\MessageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ParticipantRepository::class, \App\Repositories\ParticipantRepositoryEloquent::class);
    }
}
