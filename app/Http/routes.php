<?php
Route::group(['middleware'=>'web'], function(){
    /**
     * Backend Auth Routes...
     * Namespace indicate the folder structure
     */
    Route::group(['namespace'=>'Backend','prefix'=>'backend'], function(){
       require __DIR__.'/Routes/Backend/Auth.php';
    });
});
