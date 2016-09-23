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
}