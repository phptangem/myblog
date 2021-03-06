<?php

namespace App\Models\Access\Role\Traits\Relationship;

trait RoleRelationship
{
    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(config('access.permission'),config('access.permission_role_table'),'role_id','permission_id');
    }

    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsToMany(config('access.user'), config('access.assigned_roles_table'), 'role_id', 'user_id');
    }
}