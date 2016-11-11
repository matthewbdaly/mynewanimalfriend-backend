<?php

namespace AnimalFriend\Providers;

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
        $this->app->bind(
            'AnimalFriend\Repositories\Interfaces\PetRepositoryInterface',
            'AnimalFriend\Repositories\EloquentPetRepository'
        );
        $this->app->bind(
            'AnimalFriend\Repositories\Interfaces\UserRepositoryInterface',
            'AnimalFriend\Repositories\EloquentUserRepository'
        );
    }
}
