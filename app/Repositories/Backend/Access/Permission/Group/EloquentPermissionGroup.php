<?php
namespace App\Repositories\Backend\Access\Permission\Group;

use App\Models\Access\Permission\PermissionGroup;

class EloquentPermissionGroup implements PermissionGroupRepository
{
    public function getAllGroups($withChildren = false)
    {
        if(! $withChildren){
            return PermissionGroup::orderBy('name', 'asc')->get();
        }

        return PermissionGroup::with('children', 'permissions')
            ->whereNull('parent_id')
            ->orderBy('sort','asc')
            ->get();
    }
}