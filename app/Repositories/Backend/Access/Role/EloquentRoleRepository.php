<?php
namespace App\Repositories\Backend\Access\Role;
use App\Exceptions\GeneralException;
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
    /**
     * @param $input
     * @return bool
     * @throws GeneralException
     */
    public function create($input)
    {
        if (Role::where('name', $input['name'])->first()) {
            throw new GeneralException(trans('exceptions.backend.access.roles.already_exists'));
        }

        //See if the role has all access
        $all = $input['associated-permissions'] == 'all' ? true : false;

        //This config is only required if all is false
        if (!$all)
            //See if the role must contain a permission as per config
        {
            if (config('access.roles.role_must_contain_permission') && count($input['permissions']) == 0) {
                throw new GeneralException(trans('exceptions.backend.access.roles.needs_permission'));
            }
        }

        $role       = new Role;
        $role->name = $input['name'];
        $role->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int) $input['sort'] : 0;

        //See if this role has all permissions and set the flag on the role
        $role->all = $all;

        if ($role->save()) {
            if (!$all) {
                $current     = explode(',', $input['permissions']);
                $permissions = [];

                if (count($current)) {
                    foreach ($current as $perm) {
                        if (is_numeric($perm)) {
                            array_push($permissions, $perm);
                        }

                    }
                }
                $role->attachPermissions($permissions);
            }

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.roles.create_error'));
    }
}