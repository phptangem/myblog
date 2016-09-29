<?php
namespace App\Repositories\Backend\Access\Permission\Group;

use App\Exceptions\GeneralException;
use App\Models\Access\Permission\PermissionGroup;
use App\Models\Access\Role\Role;

class EloquentPermissionGroupRepository implements PermissionGroupRepositoryContract
{
    /**
     * @param bool $withOutChildren
     * @return mixed
     */
    public function getAllGroups($withOutChildren = false)
    {
        if($withOutChildren){
            return PermissionGroup::orderBy('name', 'asc')->get();
        }

        return PermissionGroup::with('children', 'permissions')
            ->whereNull('parent_id')
            ->orderBy('sort','asc')
            ->get();
    }


}