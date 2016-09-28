<?php
namespace App\Repositories\Backend\Access\Permission\Group;

interface PermissionGroupRepository
{
    /**
     * @param $withChildren
     * @return mixed
     */
    public function getAllGroups($withChildren);
}