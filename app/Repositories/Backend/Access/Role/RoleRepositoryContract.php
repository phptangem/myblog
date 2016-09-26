<?php
namespace App\Repositories\Backend\Access\Role;

interface RoleRepositoryContract
{
    /**
     * @param string $orderBy
     * @param string $sort
     * @param bool $withRoles
     * @return mixed
     */
    public function getAllRoles($orderBy = 'sort', $sort = 'asc', $withRoles = true);
}