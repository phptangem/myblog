<?php
namespace App\Models\Access\Role\Traits;

trait RoleAccess
{
    /**
     * @param $permission
     */
    public function attachPermission($permission)
    {
        if (is_object($permission)) {
            $permission = $permission->getKey();
        }
        if (is_array($permission)) {
            $permission = $permission['id'];
        }

        $this->permissions()->attach($permission);
    }

    /**
     * @param $permission
     */
    public function detachPermission($permission)
    {
        if (is_object($permission)) {
            $permission = $permission->getKey();
        }
        if (is_array($permission)) {
            $permission = $permission['id'];
        }
        $this->permissions()->detach($permission);
    }

    /**
     * @param $permissions
     */
    public function detachPermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->detachPermission($permission);
        }
    }

    /**
     * @param $permissions
     */
    public function attachPermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->attachPermission($permission);
        }
    }
}