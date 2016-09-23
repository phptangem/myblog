<?php
namespace App\Services\Access\Traits;

trait ConfirmUsers
{
    /**
     * @param $uid
     * @return mixed
     */
    public function resendConfirmationEmail($uid)
    {
        $this->user->resendConfirmationEmail($uid);
        return redirect()->route('backend.auth.login')->withFlashSuccess(trans('exceptions.backend.auth.confirmation.resend'));
    }

    /**
     * @param $token
     * @return mixed
     */
    public function confirmAccount($token)
    {
        $this->user->confirmAccount($token);
        return redirect()->route('backend.auth.login')->withFlashSuccess(trans('exceptions.backend.auth.confirmation.success'));
    }
}