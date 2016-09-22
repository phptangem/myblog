<?php

Route::group(['namespace' => 'Auth'], function(){

    /**
     * The routes require the users not be logged in.
     */
    Route::group(['middleware' => 'guest'], function(){
        //Authenticates routes...
        Route::get('login', 'AuthController@showLoginForm')->name('backend.auth.login');
        Route::post('login', 'AuthController@login');
        //Password reset routes...
        Route::get('password/reset/{token?}', 'PasswordController@showResetForm')->name('backend.password.reset');
        Route::post('password/email', 'PasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'PasswordController@reset');
    });
});