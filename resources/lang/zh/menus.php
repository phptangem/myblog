<?php
return [
    'backend' => [
        'access' => [
            'title' => '访问控制',
            'users' => [
                'main' => '用户管理',
                'all' => '用户列表',
                'create' => '创建用户',
                'deactivated' => '禁用列表',
                'deleted' => '删除列表',
            ],
            'roles' => [
                'main' =>'角色管理',
                'all' => '角色列表',
                'create' => '创建角色',
            ],
            'permissions' => [
                'main' => '权限管理',
                'groups' => [
                    'create' => '创建权限组',
                    'all' => '权限组列表',
                ],
                'create' => '创建权限',
                'all' => '权限列表',
            ],
        ],
        'sidebar' => [
            'dashboard' => '后台首页',
            'general' => '选项列表',
        ],
       'log-viewer' => [
         'dashboard' => '日志中心',
         'logs' => '日志列表',
         'main' => '日志管理',
       ],

    ],
];