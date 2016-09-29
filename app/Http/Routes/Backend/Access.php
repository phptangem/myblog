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
        Route::get('users/deactivated', 'UserController@deactivated')->name('backend.access.users.deactivated');
        Route::get('users/deleted', 'UserController@deleted')->name('backend.access.users.deleted');
        /**
         * Specific user
         */
        Route::group(['prefix' => 'user/{id}','where'=>['id'=>'[0-9]+']], function(){
            Route::get('mark/{status}', "UserController@mark")->name('backend.access.users.mark')->where(['status' => '[0,1]']);
            Route::get('password/change', "UserController@showUpdatePasswordForm")->name('backend.access.users.change-password');
            Route::post('password/change', "UserController@updatePassword")->name('backend.access.users.change-password');
            Route::get('restore', 'UserController@restore')->name('backend.access.users.restore');
            Route::get('delete', 'UserController@delete')->name('backend.access.users.delete-permanently');
        });

    });
    /**
     * Role management
     */
    Route::group(['namespace' => 'Role'], function(){
        Route::resource('roles','RoleController', ['except' => 'show']);
    });

    /**
     * Permission management
     */
    Route::group(['namespace' => 'Permission'], function(){
        Route::resource('permissions','PermissionController');
        Route::resource('permission-group','PermissionGroupController');
    });
});