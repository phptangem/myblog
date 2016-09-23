<?php

namespace App\Providers;

use App\Services\Access\Access;
use Illuminate\Support\ServiceProvider;

class AccessServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAccess();
        $this->registerFacade();
        $this->registerBindings();
    }

    /**
     * Register the application bindings
     */
    private function registerAccess()
    {
        $this->app->bind('access', function($app){
            return new Access($app);
        });
    }

    /**
     * Register the facade without the user having to add it to app.profile
     */
    private function registerFacade()
    {
        $this->app->booting(function(){
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Access',  \App\Services\Access\Facades\Access::class);
        });
    }

    /**
     * Register service provider bindings
     */
    private function registerBindings()
    {
        $this->app->bind(
            \App\Repositories\Backend\Access\User\UserRepositoryContract::class,
            \App\Repositories\Backend\Access\User\EloquentUserRepository::class
            );
    }
}
