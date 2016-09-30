<?php
namespace App\Repositories\Backend\Access\Permission\Group;

interface PermissionGroupRepositoryContract
{
    /**
     * @param $withChildren
     * @return mixed
     */
    public function getAllGroups($withChildren);

    /**
     * @param $input
     * @return mixed
     */
    public function store($input);

    /**
     * @param $hierarchy
     * @return mixed
     */
    public function updateSort($hierarchy);

    /**
     * @param $id
     * @return mixed
     */
    public function find($id);
    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id);

    /**
     * @param $id
     * @param $input
     * @return mixed
     */
    public function update($id,$input);

}