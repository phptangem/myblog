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

    /**
     * @param $perPage
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getRolesPaginated($perPage, $orderBy = 'id', $sort = 'asc');

    /**
     * @param $input
     * @return mixed
     */
    public function create($input);

    /**
     * @param $id
     * @param bool|false $withPermissions
     * @return mixed
     */
    public function findOrThrowException($id, $withPermissions =false);

    /**
     * @param $id
     * @param $input
     * @return mixed
     */
    public function update($id,$input);

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id);
}