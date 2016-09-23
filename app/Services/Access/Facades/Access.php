<?php
namespace App\Services\Access\Facades;

use Illuminate\Support\Facades\Facade;

class Access extends Facade
{
    /**
     * Get the registered name of the component
     */

    protected static  function getFacadeAccessor()
    {
        return 'access';
    }
}