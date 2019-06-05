<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PasswordResetRepository::class, \App\Repositories\PasswordResetRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EventRepositoryEloquent::class, \App\Repositories\EventRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MessageRepositoryEloquent::class, \App\Repositories\MessageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ParticipantRepository::class, \App\Repositories\ParticipantRepositoryEloquent::class);
        //:end-bindings:
    }
}
