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

    /**
     * @param $role
     */
    public function attachRole($role)
    {
        if(is_object($role)){
            $role = $role->getKey();
        }
        if(is_array($role)){
            $role = $role['id'];
        }

        $this->roles()->attach($role);
    }

    /**
     * @param $roles
     */
    public function attachRoles($roles)
    {
        foreach($roles as $role){
            $this->attachRole($role);
        }
    }

    /**
     * @param $permission
     */
    public function attachPermission($permission)
    {
        if(is_object($permission)){
            $permission = $permission->getKey();
        }
        if(is_array($permission)){
            $permission = $permission['id'];
        }
        $this->permissions()->attach($permission);
    }

    /**
     * @param $permissions
     */
    public function attachPermissions($permissions)
    {
        if(count($permissions)){
            foreach($permissions as $permission){
                $this->attachPermission($permission);
            }
        }
    }

    /**
     * @param $permission
     */
    public function detachPermission($permission)
    {
        if(is_object($permission)){
            $permission = $permission->getKey();
        }
        if(is_array($permission)){
            $permission = $permission['id'];
        }

        $this->permissions()->detach($permission);
    }

    /**
     * @param $permissions
     */
    public function detachPermissions($permissions)
    {
        if(count($permissions)){
            foreach($permissions as $permission){
                $this->detachPermission($permission);
            }
        }
    }

    /**
     * @param $role
     */
    public function detachRole($role)
    {
        if(is_object($role)){
            $role = $role->getKey();
        }
        if(is_array($role)){
            $role = $role['id'];
        }

        $this->roles()->detach($role);
    }

    /**
     * @param $roles
     */
    public function detachRoles($roles)
    {
        if(count($roles)){
            foreach($roles as $role){
                $this->detachRole($role);
            }
        }
    }
}