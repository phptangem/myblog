<?php
namespace App\Repositories\Backend\Access\User;

use App\Exceptions\Backend\Access\User\UserNeedsRoleException;
use App\Exceptions\GeneralException;
use App\Models\Access\User\User;
use Illuminate\Support\Facades\Mail;

class EloquentUserRepository implements UserRepositoryContract
{
    /**
     * @param $uid
     * @return mixed
     */
    public function find($uid)
    {
        return User::findOrFail($uid);
    }

    /**
     * @param $token
     * @return mixed
     * @throws GeneralException
     */
    public function findByToken($token)
    {
        $user = User::where('confirmation_code'.$token)->first();
        if(! $user instanceof User){
            throw new GeneralException(trans('exceptions.backend.auth.confirmation.not_found'));
        }

        return $user;
    }
    /**
     * @param $user
     * @return mixed
     */
    public function sendConfirmationEmail($user)
    {
        if(! $user instanceof User){
            $user = $this->find($user);
        }

        return Mail::send('backend.auth.emails.confirm',['token' => $user->confirmation_code], function($message) use($user){
            $message->to($user->email,$user->name)->subject(app_name().': '.trans('exceptions.backend.auth.confirmation.confirm'));
        });
    }

    /**
     * @param $uid
     * @return mixed|void
     */
    public function resendConfirmationEmail($uid)
    {
        return $this->sendConfirmationEmail($this->find($uid));
    }

    /**
     * @param $token
     * @return mixed
     * @throws GeneralException
     */
    public function confirmAccount($token)
    {
        $user = $this->findByToken($token);

        if($user->confirmed == 1){
            throw new GeneralException(trans('exceptions.backend.auth.confirmation.already_confirm'));
        }

        $user->confirmed = 1;
        return $user->save();
    }

    /**
     * @param $perPage
     * @param int $status
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getUserPaginated($perPage, $status = 1, $orderBy = 'id', $sort = 'asc')
    {
        return User::where('status',$status)
            ->orderBy($orderBy,$sort)
            ->paginate($perPage);
    }

    /**
     * @param $id
     * @param $status
     * @return bool
     * @throws GeneralException
     */
    public function mark($id, $status)
    {
        if(access()->id() == $id && $status ==0){
            throw new GeneralException(trans('exceptions.backend.access.users.cant_deactivate_self'));
        }
        $user         = $this->findOrThrowException($id);
        $user->status = $status;

        if ($user->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.mark_error'));
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrThrowException($id, $withRoles = false)
    {
        if($withRoles){
            $user = User::with('roles')->withTrashed()->find($id);
        }else{
            $user = User::withTrashed()->find($id);
        }
        if(! is_null($user)){
            return $user;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.not_found'));
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function destroy($id)
    {
        if(access()->id() == $id){
            throw new GeneralException(trans('exceptions.backend.access.users.cant_delete_self'));
        }

        $user = $this->findOrThrowException($id);
        if($user->delete()){
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.delete_error'));
    }

    /**
     * @param $perPage
     * @return mixed
     */
    public function getDeletedUsersPaginated($perPage)
    {
        return User::onlyTrashed()
            ->paginate($perPage);
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     */
    public function create($input, $roles, $permissions)
    {
        $user = $this->createUserStub($input);
        if($user->save()){
            //用户必须绑定角色，否则返回错误到更新页
            $this->validateRoleAmount($user, $roles['assignees_roles']);

            //绑定角色
            $user->attachRoles($roles['assignees_roles']);

            //绑定权限
            $user->attachPermissions($permissions['permission_user']);

            if(isset($input['confirmation_email']) && $user->confirmed == 0){
                $this->sendConfirmationEmail($user->id);
            }

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
    }

    /**
     * @param $id
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws UserNeedsRoleException
     */
    public function update($id, $input, $roles, $permissions)
    {
        $user = $this->findOrThrowException($id);
        $this->checkUserByEmail($input,$user);
//        $input['updated_at'] = date("Y-m-d H:i:s");
        if($user->update($input)){
            $this->validateRoleAmount($user,$roles);
            $this->flushRoles($user, $roles);
            $this->flushPermissions($user, $permissions);
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.update_error'));
    }

    /**
     * @param $id
     * @param $input
     * @return bool
     * @throws GeneralException
     */
    public function updatePassword($id, $input)
    {
        $user = $this->findOrThrowException($id);
        $user->password = bcrypt($input['password']);
        if($user->save()){
            return true;
        }

        throw  new GeneralException(trans('exceptions.backend.access.users.update_password_error'));
    }
    /**
     * @param $user
     * @param $roles
     */
    private function flushRoles($user, $roles)
    {
        $user->detachRoles($user->roles);
        $user->attachRoles($roles['assignees_roles']);
    }

    /**
     * @param $user
     * @param $permissions
     */
    private function flushPermissions($user, $permissions)
    {
        $user->detachPermissions($user->permissions);
        if(count($permissions['permission_user']))
            $user->attachPermissions($permissions['permission_user']);
    }
    /**
     * @param $input
     * @param $user
     * @throws GeneralException
     */
    private function checkUserByEmail($input, $user)
    {
        if($user->email != $input['email']){
            if(User::where('email', $input['email'])->first()){
                throw new GeneralException(trans('exceptions.backend.access.users.email_error'));
            }
        }
    }

    /**
     * @param $user
     * @param $input
     */
    private function updateUserStub($user, $input)
    {
        $user->name = $input['name'];
        $user->email = $input['email'];
        if(isset($input['password'])){
            $user->password = bcrypt($input['password']);
        }
        $user->save();
    }
    /**
     * @param $input
     * @return User
     */
    private function createUserStub($input)
    {
        $user                       = new User();
        $user->name                 = $input['name'];
        $user->email                = $input['email'];
        $user->password             = bcrypt($input['password']);
        $user->status               = isset($input['status']) ? 1 : 0;
        $user->confirmation_code    = md5(uniqid(mt_rand(), true));
        $user->confirmed            = isset($input['confirmed']) ? 1 : 0;

        return $user;
    }

    /**
     * @param $user
     * @param $roles
     * @throws UserNeedsRoleException
     */
    private function validateRoleAmount($user, $roles)
    {
        if(! count($roles)){
            $user->status = 0;
            $user->save();

            $exception = new UserNeedsRoleException();
            $exception->setValidationErrors(trans('exceptions.backend.access.users.role_needed_create'));
            $exception->setUserID($user->id);
            throw $exception;
        }
    }


}