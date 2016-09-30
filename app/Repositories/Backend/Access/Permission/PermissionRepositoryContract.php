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

    /**
     * @return mixed
     */
    public function getUngroupedPermissions();

    /**
     * @param $perPage
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getPermissionsPaginated($perPage, $orderBy = 'display_name', $sort = 'asc');

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id);

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     */
    public function findOrThrowException($id,$withRoles = false);
}