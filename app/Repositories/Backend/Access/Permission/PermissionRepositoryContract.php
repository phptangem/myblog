<?php
namespace App\Repositories\Backend\Access\Permission;

interface PermissionRepositoryContract
{
    /**
     * @param string $orderBy
     * @param string $sort
     * @param bool $withRoles
     * @return mixed
     */
    public function getAllPermissions($orderBy = 'display_name', $sort = 'asc', $withRoles = true);
}