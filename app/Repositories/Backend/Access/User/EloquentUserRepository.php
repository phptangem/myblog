<?php
namespace App\Repositories\Backend\Access\User;

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

}