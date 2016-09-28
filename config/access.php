<?php
return [
    'users' => [
        'confirm_email' => false,
        'default_per_page' => 10,
    ],

    /*
    |--------------------------------------------------------------------------
    | Access
    |--------------------------------------------------------------------------
    |
    | 权限相关表
    |
    */
    'users_table' => 'users',
    'roles_table' => 'roles',
    'assigned_roles_table' => 'assigned_roles',
    'permissions_table' => 'permissions',
    'permission_group_table' => 'permission_group',
    'permission_role_table' => 'permission_role',
    'permission_dependencies_table' => 'permission_dependencies',
    'permission_user_table' => 'permission_user',
    /*
     |
     |权限模型完整类名
     |
     */
    'user' => \App\Models\Access\User\User::class,
    'role' => \App\Models\Access\Role\Role::class,
    'permission' => \App\Models\Access\Permission\Permission::class,
    'group' => \App\Models\Access\Permission\PermissionGroup::class,
    'dependency' => \App\Models\Access\Permission\PermissionDependency::class,
];