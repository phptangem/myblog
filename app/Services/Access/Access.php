<?php
namespace App\Services\Access;

use App\Exceptions\GeneralException;

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


    /**
     * 当前用户是否拥有制定权限
     * @param $permission 权限名 或 权限ID
     * @return bool
     */
    public function allow($permission)
    {
        if($user = $this->user()){
            return $user->allow($permission);
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function id()
    {
        return auth()->id();
    }

    /**
     * @param $permissions
     * @param bool $needsAll
     * @return bool
     */
    public function allowMultiple($permissions, $needsAll = false)
    {
        if($user = $this->user()){
            if(! is_array($permissions)){
                $permissions = (array)$permissions;
            }
            return $user->allowMultiple($permissions, $needsAll);
        }

        return false;
    }
}