<?php
namespace App\Services\Access;

class Access
{
    public $app;


    /**
     * Create a new confide instance.
     * @param $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Get the currently authenticated user or null
     */
    public function user()
    {
        return auth()->user();
    }
}