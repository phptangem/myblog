<?php
namespace App\Repositories\Backend\Access\Permission;
use App\Exceptions\GeneralException;
use App\Models\Access\Permission\Permission;
class EloquentPermissionRepository implements PermissionRepositoryContract
{
    /**
     * @param string $orderBy
     * @param string $sort
     * @param bool $withRoles
     * @return mixed
     */
    public function getAllPermissions($orderBy = 'display_name', $sort = 'asc', $withRoles = true)
    {
        if($withRoles){
            return Permission::with('roles','dependencies.permission')
                ->orderBy($orderBy, $sort)
                ->get();
        }

        return Permission::with('dependencies.permission')
            ->orderBy($orderBy, $sort)
            ->get();
    }

    /**
     * @return mixed
     */
    public function getUngroupedPermissions()
    {
        return Permission::whereNull('group_id')
            ->orderBy('display_name','asc')
            ->get();
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getPermissionsPaginated($per_page, $order_by = 'display_name', $sort = 'asc')
    {
        return Permission::with('roles')->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function destroy($id)
    {
        $permission = $this->findOrThrowException($id);

        if ($permission->system == 1) {
            throw new GeneralException(trans('exceptions.backend.access.permissions.system_delete_error'));
        }

        //Remove the permission from all associated roles
        $currentRoles = $permission->roles;
        foreach ($currentRoles as $role) {
            $role->detachPermission($permission);
        }

        //Remove the permission from all associated users
        $currentUsers = $permission->users;
        foreach ($currentUsers as $user) {
            $user->detachPermission($permission);
        }

        //Remove the dependencies
        $permission->dependencies()->delete();

        if ($permission->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.permissions.delete_error'));
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     * @throws GeneralException
     */
    public function findOrThrowException($id, $withRoles = false)
    {
        if (! is_null(Permission::find($id))) {
            if ($withRoles) {
                return Permission::with('roles')->find($id);
            }

            return Permission::find($id);
        }

        throw new GeneralException(trans('exceptions.backend.access.permissions.not_found'));
    }
}