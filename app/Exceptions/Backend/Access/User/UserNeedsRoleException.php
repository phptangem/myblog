<?php
namespace App\Exceptions\Backend\Access\User;

class UserNeedsRoleException extends \Exception
{
    public $validationErrors;
    public $userID;

    /**
     * @param $id
     */
    public function setUserID($id)
    {
        $this->userID = $id;
    }

    /**
     * @param $validationErrors
     */
    public function setValidationErrors($validationErrors)
    {
        $this->validationErrors = $validationErrors;
    }

    /**
     * @return mixed
     */
    public function getValidationErrors()
    {
        return $this->validationErrors;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }
}