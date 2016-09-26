<?php
namespace App\Models\Access\Permission\Traits\Relationship;

trait PermissionDependencyRelationship
{
    /**
     * @return mixed
     */
    public function permission()
    {
        return $this->hasOne(config('access.permission'),'permission_id','id');
    }
}