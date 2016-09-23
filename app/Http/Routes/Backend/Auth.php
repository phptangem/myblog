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
        //Confirm account routes...
        Route::get("account/confirm/{token}", 'AuthController@confirmAccount')->name('backend.account.confirm');
        Route::get("account/confirm/resend/{uid}", 'AuthController@resendConfirmationEmail')->name('backend.account.confirm.resend');
    });

    /**
     * The routes require the users be logged in.
     */
    Route::group(['middleware' => 'auth'], function(){
        Route::get('logout', 'AuthController@logout')->name('backend.auth.logout');
    });
});