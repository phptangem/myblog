<?php
namespace App\Repositories\Backend\Access\Role;
use App\Models\Access\Role\Role;

class EloquentRoleRepository implements RoleRepositoryContract
{

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
}