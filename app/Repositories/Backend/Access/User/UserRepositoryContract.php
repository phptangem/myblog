<?php
namespace App\Repositories\Backend\Access\User;

interface UserRepositoryContract
{
    /**
     * @param $uid
     * @return mixed
     */
    public function find($uid);
    /**
     * @param $token
     * @return mixed
     */
    public function confirmAccount($token);

    /**
     * @param $uid
     * @return mixed
     */
    public function resendConfirmationEmail($uid);

    /**
     * @param $user
     * @return mixed
     */
    public function sendConfirmationEmail($user);

    /**
     * @param $token
     * @return mixed
     */
    public function findByToken($token);
}