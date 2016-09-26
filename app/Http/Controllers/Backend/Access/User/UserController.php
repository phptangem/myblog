<?php

namespace App\Http\Controllers\Backend\Access\User;

use App\Http\Requests\Backend\Access\User\ChangePasswordRequest;
use App\Http\Requests\Backend\Access\User\DeleteUserRequest;
use App\Http\Requests\Backend\Access\User\MarkRequest;
use App\Repositories\Backend\Access\Permission\EloquentPermissionRepository;
use App\Repositories\Backend\Access\Role\EloquentRoleRepository;
use App\Repositories\Backend\Access\User\EloquentUserRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $users;
    protected $roles;
    protected $permissions;
    public function __construct(
        EloquentUserRepository $users,
        EloquentRoleRepository $roles,
        EloquentPermissionRepository $permissions
    )
    {
        $this->users = $users;
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    public function index()
    {
        return view('backend.access.user.index')
            ->withUsers($this->user->getUserPaginated(config('access.users.default_per_page'), 1));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.access.user.create')
            ->withRoles($this->roles->getAllRoles('sort', 'asc',true))
            ->withPermissions($this->permissions->getAllPermissions());
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
     * @param $id
     * @param DeleteUserRequest $request
     * @return mixed
     */
    public function destroy($id, DeleteUserRequest $request)
    {
        $this->user->destory($id);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.deleted'));
    }

    /**
     * @param $id
     * @param $status
     * @param MarkRequest $request
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function mark($id,$status, MarkRequest $request)
    {
        $this->user->mark($id, $status);

        return redirect()->back()->withFlashSuccess("alerts.backend.users.updated");
    }

    /**
     * @param $id
     * @param ChangePasswordRequest $request
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function changePassword($id, ChangePasswordRequest $request)
    {
        return view('backend.access.user.change-password')
            ->withUser($this->user->findOrThrowException($id));
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        return view('backend.access.deactivated')
            ->withUsers($this->user->getUserPaginated(25,0));
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        return view('backend.access.deleted')
            ->withUsers($this->user->getDeletedUsersPaginated(25));
    }
}
