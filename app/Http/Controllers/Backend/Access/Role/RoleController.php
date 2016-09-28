<?php

namespace App\Http\Controllers\Backend\Access\Role;

use App\Http\Requests\Backend\Access\Role\CreateRoleRequest;
use App\Repositories\Backend\Access\Permission\Group\PermissionGroupRepository;
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
        PermissionGroupRepository $group
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
            ->withGroups($this->group->getAllGroups())
            ->withPermissions($this->permissions->getUngroupedPermissions());
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
