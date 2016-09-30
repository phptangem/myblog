<?php

namespace App\Http\Controllers\Backend\Access\Permission;

use App\Http\Requests\Backend\Access\Permission\EditPermissionRequest;
use App\Repositories\Backend\Access\Permission\Group\PermissionGroupRepositoryContract;
use App\Repositories\Backend\Access\Permission\PermissionRepositoryContract;
use App\Repositories\Backend\Access\Role\RoleRepositoryContract;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    protected  $groups;
    protected  $permissions;
    protected  $roles;

    /**
     * PermissionController constructor.
     * @param PermissionGroupRepositoryContract $groups
     * @param PermissionRepositoryContract $permissions
     * @param RoleRepositoryContract $roles
     */
    public function __construct(
        PermissionGroupRepositoryContract $groups,
        PermissionRepositoryContract $permissions,
        RoleRepositoryContract $roles
    )
    {
        $this->groups       = $groups;
        $this->permissions  = $permissions;
        $this->roles        = $roles;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.access.permission.index')
            ->withGroups($this->groups->getAllGroups())
            ->withPermissions($this->permissions->getPermissionsPaginated(25));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param EditPermissionRequest $request
     * @return mixed
     */
    public function edit($id, EditPermissionRequest $request)
    {
        $permission = $this->permissions->findOrThrowException($id, true);
        return view('backend.access.permission.edit')
            ->withPermission($permission)
            ->withPermissionRoles($permission->roles->lists('id')->all())
            ->withGroups($this->groups->getAllGroups(true))
            ->withRoles($this->roles->getAllRoles())
            ->withPermissions($this->permissions->getAllPermissions())
            ->withPermissionDependencies($permission->dependencies->lists('dependency_id')->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
