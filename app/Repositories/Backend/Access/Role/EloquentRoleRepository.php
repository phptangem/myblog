<?php
namespace App\Repositories\Backend\Access\Role;
use App\Models\Access\Role\Role;

class EloquentRoleRepository implements RoleRepositoryContract
{

    /**
     * @param string $orderBy
     * @param string $sort
     * @param bool|false $withPermissions
     * @return mixed
     */
    public function getAllRoles($orderBy = 'sort', $sort = 'asc',$withPermissions = false)
    {
        if($withPermissions){
            return Role::orderBy($orderBy, $sort)
                ->with('permissions')
                ->get();
        }

        return Role::orderBy($orderBy, $sort)
            ->get();
    }

    /**
     * @param $perPage
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getRolesPaginated($perPage, $orderBy = 'id', $sort='asc')
    {
        return Role::with('permissions')
            ->orderBy($orderBy, $sort)
            ->paginate($perPage);
    }
}