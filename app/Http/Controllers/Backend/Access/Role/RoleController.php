<?php

namespace App\Http\Controllers\Backend\Access\Role;

use App\Http\Requests\Backend\Access\Role\CreateRoleRequest;
use App\Http\Requests\Backend\Access\Role\DeleteRoleRequest;
use App\Http\Requests\Backend\Access\Role\EditRoleRequest;
use App\Http\Requests\Backend\Access\Role\StoreRoleRequest;
use App\Http\Requests\Backend\Access\Role\UpdateRoleRequest;
use App\Repositories\Backend\Access\Permission\Group\PermissionGroupRepositoryContract;
use App\Repositories\Backend\Access\Permission\PermissionRepositoryContract;
use App\Repositories\Backend\Access\Role\RoleRepositoryContract;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    protected $roles;
    protected $permissions;
    protected $group;
    public function __construct(
        RoleRepositoryContract $roles,
        PermissionRepositoryContract $permissions,
        PermissionGroupRepositoryContract $group
    )
    {
        $this->roles = $roles;
        $this->permissions = $permissions;
        $this->group = $group;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.access.role.index')
            ->withRoles($this->roles->getRolesPaginated(10));
    }

    /**
     * @param CreateRoleRequest $request
     */
    public function create(CreateRoleRequest $request)
    {
        return view('backend.access.role.create')
            ->withGroups($this->group->getAllGroups(false))
            ->withPermissions($this->permissions->getUngroupedPermissions());
    }

    /**
     * @param StoreRoleRequest $request
     * @return mixed
     */
    public function store(StoreRoleRequest $request)
    {
        $this->roles->create($request->all());

        return redirect()->route('backend.access.roles.index')->withFlashSuccess(trans('alerts.backend.roles.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @param EditRoleRequest $request
     */
    public function edit($id, EditRoleRequest $request)
    {
        $role = $this->roles->findOrThrowException($id);
        return view('backend.access.role.edit')
            ->withRole($role)
            ->withGroups($this->group->getAllGroups(false))
            ->withPermissions($this->permissions->getUngroupedPermissions())
            ->withRolePermissions($role->permissions->lists('id')->all());
    }

    /**
     * @param UpdateRoleRequest $request
     * @param $id
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $this->roles->update($id, $request->all());
        return redirect()->route('backend.access.roles.index')->withFlashSuccess(trans('alerts.backend.roles.updated'));
    }

    /**
     * @param $id
     * @param DeleteRoleRequest $request
     */
    public function destroy($id, DeleteRoleRequest $request)
    {
        $this->roles->destroy($id);
        return redirect()->route('backend.access.roles.index')->withFlashSuccess(trans('alerts.backend.roles.deleted'));
    }
}
