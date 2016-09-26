<?php
namespace App\Models\Access\User\Traits;

trait UserAccess
{
    /**
     * @param $nameOrId
     * @return bool
     */
    public function allow($nameOrId)
    {

        foreach ($this->roles as $role) {
            if ($role->all) {
                return true;
            }
            foreach ($role->permissions as $permission) {
                if (is_numeric($nameOrId)) {
                    if ($permission->id == $nameOrId) {
                        return true;
                    }
                } else {
                    if ($permission->name == $nameOrId) {
                        return true;
                    }
                }
            }
        }
        foreach ($this->permissions as $permission) {
            if (is_numeric($nameOrId)) {
                if ($permission->id == $nameOrId) {
                    return true;
                }
            } else {
                if ($permission->name == $nameOrId) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @param $permissions
     * @param bool $needsAll
     * @return bool
     */
    public function allowMultiple($permissions, $needsAll = false)
    {
        foreach($permissions as $permission){
            if($needsAll && !$this->allow($permission)){
                return false;
            }
            if(! $needsAll && $this->allow($permission)){
                return true;
            }
        }
        return true;
    }
}