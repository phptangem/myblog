<?php

namespace App\Providers;

use App\Services\Access\Access;
use Illuminate\Support\ServiceProvider;
use Blade;
class AccessServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerBladeExtensions();
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
        $this->app->bind(
            \App\Repositories\Backend\Access\Role\RoleRepositoryContract::class,
            \App\Repositories\Backend\Access\Role\EloquentRoleRepository::class
        );
        $this->app->bind(
            \App\Repositories\Backend\Access\Permission\PermissionRepositoryContract::class,
            \App\Repositories\Backend\Access\Permission\EloquentPermissionRepository::class
        );
    }

    /**
     * new blade extension
     */
    private function registerBladeExtensions()
    {
        Blade::directive('permission', function($permission){
            return "<?php if(access()->allow{$permission}): ?>";
        });
        Blade::directive('permissions', function($permission){
            return "<?php if(access()->allowMultiple{$permission}): ?>";
        });
        Blade::directive('endauth', function(){
            return "<?php endif; ?>";
        });
    }
}
