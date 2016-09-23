<?php
if(!function_exists('app_name')){
    /**
     * Helper to grap the application name
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}
if(!function_exists('access')){
    /**
     * Access (lol) the Access:: facade as a simple function
     */
    function access()
    {
        return app('access');
    }
}