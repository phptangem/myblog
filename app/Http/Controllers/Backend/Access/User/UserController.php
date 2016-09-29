<?php

namespace App\Http\Controllers\Backend\Access\User;

use App\Http\Requests\Backend\Access\User\ChangePasswordRequest;
use App\Http\Requests\Backend\Access\User\DeleteUserRequest;
use App\Http\Requests\Backend\Access\User\EditUserRequest;
use App\Http\Requests\Backend\Access\User\MarkUserRequest;
use App\Http\Requests\Backend\Access\User\PermanentlyDeleteUserRequest;
use App\Http\Requests\Backend\Access\User\RestoreUserRequest;
use App\Http\Requests\Backend\Access\User\StoreUserRequest;
use App\Http\Requests\Backend\Access\User\UpdatePasswordRequest;
use App\Http\Requests\Backend\Access\User\UpdateUserRequest;
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
            ->withUsers($this->users->getUserPaginated(config('access.users.default_per_page'), 1));
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
    public function store(StoreUserRequest $request)
    {
        $this->users->create(
            $request->except('assignees_roles','permission_user'),
            $request->only('assignees_roles'),
            $request->only('permission_user')
            );

        return redirect()->route('backend.access.users.index')->withFlashSuccess(trans('alerts.backend.users.created'));
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
     * @param EditUserRequest $request
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function edit($id, EditUserRequest $request)
    {
        $user = $this->users->findOrThrowException($id, false);
        return view('backend.access.user.edit')
            ->withUser($user)
            ->withUserRoles($user->roles->lists('id')->all())
            ->withRoles($this->roles->getAllRoles('sort', 'asc',true))
            ->withUserPermissions($user->permissions->lists('id')->all())
            ->withPermissions($this->permissions->getAllPermissions());
    }

    /**
     * @param UpdateUserRequest $request
     * @param $id
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $this->users->update(
            $id,
            $request->except('assignees_roles','permission_user'),
            $request->only('assignees_roles'),
            $request->only('permission_user')
        );

        return redirect()->route('backend.access.users.index')->withFlashSuccess(trans('alerts.backend.users.updated'));
    }


    /**
     * @param $id
     * @param DeleteUserRequest $request
     * @return mixed
     */
    public function destroy($id, DeleteUserRequest $request)
    {
        $this->users->destroy($id);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.deleted'));
    }

    /**
     * @param $id
     * @param $status
     * @param MarkUserRequest $request
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function mark($id,$status, MarkUserRequest $request)
    {
        $this->users->mark($id, $status);

        return redirect()->back()->withFlashSuccess($status == 0 ? trans("alerts.backend.users.deactivated"):trans("alerts.backend.users.activated"));
    }

    /**
     * @param $id
     * @param ChangePasswordRequest $request
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function showUpdatePasswordForm($id, ChangePasswordRequest $request)
    {
        return view('backend.access.user.change-password')
            ->withUser($this->users->findOrThrowException($id));
    }

    public function updatePassword($id, UpdatePasswordRequest $request)
    {
        $this->users->updatePassword($id,$request->only('password'));
        return redirect()->route('backend.access.users.index')->withFlashSuccess(trans('alerts.backend.users.updated_password'));
    }
    /**
     * @return mixed
     */
    public function deactivated()
    {
        return view('backend.access.user.deactivated')
            ->withUsers($this->users->getUserPaginated(10,0));
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        return view('backend.access.user.deleted')

            ->withUsers($this->users->getDeletedUsersPaginated(25));
    }

    /**
     * @param $id
     * @param RestoreUserRequest $request
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore($id, RestoreUserRequest $request)
    {
        $this->users->restore($id);

        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.restored'));
    }

    /**
     * @param $id
     * @param PermanentlyDeleteUserRequest $request
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function delete($id , PermanentlyDeleteUserRequest $request)
    {
        $this->users->delete($id);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.deleted_permanently'));
    }
}
