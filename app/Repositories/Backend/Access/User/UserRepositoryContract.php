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

    /**
     * @param $perPage
     * @param int $status
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getUserPaginated($perPage,$status = 1, $orderBy = 'id', $sort = 'asc');

    /**
     * @param $id
     * @param $status
     * @return mixed
     */
    public function mark($id, $status);

    /**
     * @param $perPage
     * @return mixed
     */
    public function getDeletedUsersPaginated($perPage);

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return mixed
     */
    public function create($input, $roles, $permissions);
}