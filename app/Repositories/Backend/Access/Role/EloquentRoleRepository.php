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

        $all = $input['associated-permissions'] == 'all' ? true : false;

        if (!$all)
        {
            if (config('access.roles.role_must_contain_permission') && count($input['permissions']) == 0) {
                throw new GeneralException(trans('exceptions.backend.access.roles.needs_permission'));
            }
        }

        $role       = new Role;
        $role->name = $input['name'];
        $role->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int) $input['sort'] : 0;

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

    /**
     * @param $id
     * @param bool|false $withPermissions
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     * @throws GeneralException
     */
    public function findOrThrowException($id, $withPermissions = false)
    {
        if(! is_null(Role::find($id))){
            if($withPermissions){
                return Role::with('permissions')->find($id);
            }
            return Role::find($id);
        }
        throw new GeneralException(trans('exceptions.backend.access.roles.not_found'));
    }

    /**
     * @param $id
     * @param $input
     * @return bool
     * @throws GeneralException
     */
    public function update($id, $input)
    {
        $role = $this->findOrThrowException($id);

        if ($role->id == 1) {
            $all = true;
        } else {
            $all = $input['associated-permissions'] == 'all' ? true : false;
        }


        if (! $all) {
            if (config('access.roles.role_must_contain_permission') && count($input['permissions']) == 0) {
                throw new GeneralException(trans('exceptions.backend.access.roles.needs_permission'));
            }
        }

        $role->name = $input['name'];
        $role->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int) $input['sort'] : 0;

        $role->all = $all;

        if ($role->save()) {
            if ($all) {
                $role->permissions()->sync([]);
            } else {
                $role->permissions()->sync([]);

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

        throw new GeneralException(trans('exceptions.backend.access.roles.update_error'));
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     * @throws \Exception
     */
    public function destroy($id)
    {
        if ($id == 1) {
            throw new GeneralException(trans('exceptions.backend.access.roles.cant_delete_admin'));
        }

        $role = $this->findOrThrowException($id, true);

        if ($role->users()->count() > 0) {
            throw new GeneralException(trans('exceptions.backend.access.roles.has_users'));
        }

        $role->permissions()->sync([]);

        if ($role->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.roles.delete_error'));
    }
}