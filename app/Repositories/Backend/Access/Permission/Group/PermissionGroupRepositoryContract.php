<?php
namespace App\Repositories\Backend\Access\Permission\Group;

interface PermissionGroupRepositoryContract
{
    /**
     * @param $withChildren
     * @return mixed
     */
    public function getAllGroups($withChildren);
}