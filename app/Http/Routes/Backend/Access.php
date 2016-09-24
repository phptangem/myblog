<?php
Route::group([
    'prefix' => 'access',
    'namespace' => 'Access',
//    'middleware' => 'access.routeNeedsPermission:view-access-management',
],function(){
    /**
     * User management
     */
    Route::group(['namespace' => 'User'], function(){
        Route::resource('users','UserController', ['except'=>['show']]);

        /**
         * Specific user
         */
        Route::group(['prefix' => 'user/{id}','where'=>['id'=>'[0-9]+']], function(){
            Route::get('mask', "UserController@mask")->name('backend.access.user.mark')->where(['status' => '[0,1]']);
            Route::get('password/change', "UserController@changePassword")->name('backend.access.user.change-password');
        });

    });
});