<?php
namespace App\Models\Access\Permission\Traits\Relationship;

trait PermissionGroupRelationship
{
    public function children()
    {
        return $this->hasMany(config('access.group'), 'parent_id', 'id');
    }

    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->hasMany(config('access.permission'),'group_id', 'id');
    }
}