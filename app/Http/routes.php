<?php
Route::group(['middleware'=>'web'], function(){
    /**
     * Frontend Routes
     */
    Route::group(['namespace'=>'Frontend'], function(){
        require __DIR__.'/Routes/Frontend/Frontend.php';
    });

});

/**
 * Backend  Routes...
 * Namespace indicate the folder structure
 */
Route::group(['namespace'=>'Backend','prefix'=>'backend'], function(){
    /**
     * Backend Auth Routes
     */
    require __DIR__.'/Routes/Backend/Auth.php';

    /**
     *Backend Routes
     *Admin middleware groups web, auth and routesNeedPermission
     */
    Route::group(['middleware'=>'backend'] ,function(){
        require __DIR__.'/Routes/Backend/Dashboard.php';
        require __DIR__.'/Routes/Backend/Access.php';
    });
});
