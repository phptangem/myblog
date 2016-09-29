<?php
namespace App\Repositories\Backend\Access\Permission;
use App\Models\Access\Permission\Permission;
class EloquentPermissionRepository implements PermissionRepositoryContract
{
    /**
     * @param string $orderBy
     * @param string $sort
     * @param bool $withRoles
     * @return mixed
     */
    public function getAllPermissions($orderBy = 'display_name', $sort = 'asc', $withRoles = true)
    {
        if($withRoles){
            return Permission::with('roles','dependencies.permission')
                ->orderBy($orderBy, $sort)
                ->get();
        }

        return Permission::with('dependencies.permission')
            ->orderBy($orderBy, $sort)
            ->get();
    }

    /**
     * @return mixed
     */
    public function getUngroupedPermissions()
    {
        return Permission::whereNull('group_id')
            ->orderBy('display_name','asc')
            ->get();
    }
}