<?php
namespace App\Models\Access\User\Traits\Relationship;

trait UserRelationship
{
    /**
     * 用户 和 角色 多对多关系
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(config('access.role'),config('access.assigned_roles_table'),'user_id','role_id');
    }

    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(config('access.permission'),config('access.permission_user_table'),'user_id','permission_id');
    }
}