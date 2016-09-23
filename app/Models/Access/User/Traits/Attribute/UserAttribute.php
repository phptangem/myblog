<?php
namespace App\Models\Access\User\Traits\Attribute;

trait UserAttribute
{
    /**
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->confirmed == 1;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status == 1;
    }
}