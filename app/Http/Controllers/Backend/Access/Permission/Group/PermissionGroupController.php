<?php

namespace App\Http\Controllers\Backend\Access\Permission\Group;

use App\Http\Requests\Backend\Access\Permission\Group\CreatePermissionGroupRequest;
use App\Http\Requests\Backend\Access\Permission\Group\DeletePermissionGroupRequest;
use App\Http\Requests\Backend\Access\Permission\Group\EditPermissionGroupRequest;
use App\Http\Requests\Backend\Access\Permission\Group\StorePermissionGroupRequest;
use App\Http\Requests\Backend\Access\Permission\Group\UpdatePermissionGroupRequest;
use App\Http\Requests\Backend\Access\Permission\Group\UpdatePermissionGroupSortRequest;
use App\Repositories\Backend\Access\Permission\Group\PermissionGroupRepositoryContract;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PermissionGroupController extends Controller
{
    protected $groups;

    /**
     * PermissionGroupController constructor.
     * @param PermissionGroupRepositoryContract $groups
     */
    public function __construct(PermissionGroupRepositoryContract $groups)
    {
        $this->groups = $groups;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * @param CreatePermissionGroupRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(CreatePermissionGroupRequest $request)
    {
        return view('backend.access.permission.group.create');
    }

    /**
     * @param StorePermissionGroupRequest $request
     * @return mixed
     */
    public function store(StorePermissionGroupRequest $request)
    {
        $this->groups->store($request->all());
        return redirect()->route('backend.access.permissions.index')->withFlashSuccess(trans('alerts.backend.permissions.groups.created'));
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
     * @param EditPermissionGroupRequest $request
     */
    public function edit($id, EditPermissionGroupRequest $request)
    {
        return view('backend.access.permission.group.edit')
            ->withGroup($this->groups->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionGroupRequest $request, $id)
    {
        $this->groups->update($id, $request->all());
        return redirect()->route('backend.access.permissions.index')->withFlashSuccess(trans('alerts.backend.permissions.groups.created'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DeletePermissionGroupRequest $request)
    {
        $this->groups->destroy($id);
        return redirect()->route('backend.access.permissions.index')->withFlashSuccess(trans('alerts.backend.permissions.groups.deleted'));
    }

    /**
     * @param UpdatePermissionGroupSortRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateSort(UpdatePermissionGroupSortRequest $request)
    {
        $this->groups->updateSort($request->get('data'));
        return response()->json(['status' => 'OK']);
    }
}
