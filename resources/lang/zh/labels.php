<?php

return [
    'backend' => [
        'access' =>[
            'users' => [
                'management' => '用户管理',
                'active' => '正常用户',
                'create' => '新建用户',
                'permissions' => '权限',
                'all_permissions' => '全部权限',
                'no_permissions' => '无任何权限',
                'permission_check' => '选择权限',
                'dependencies' => '依赖权限',
                'deactivated'=>'禁用用户',
                'deleted' => '删除用户',
                'change_password' => '修改密码',
                'change_password_for' => '修改用户::user的密码',
                'table' => [
                    'id' => '编号',
                    'name' => '用户名',
                    'email' => '邮箱',
                    'confirmed' => '是否激活',
                    'roles' => '角色',
                    'other_permissions' => '其他权限',
                    'created' => '创建时间',
                    'last_updated' => '更新时间',
                    'total' => '用户总计:',
                ],
            ],
            'roles' => [
                'management' => '角色管理',
                'create' => '创建角色',
                'table' => [
                    'role' => '角色名',
                    'permissions' => '拥有权限',
                    'number_of_users' => '关联用户数',
                    'sort' => '排序',
                    'actions' => '操作',
                    'total' => '总计',
                ],
            ],
            'permissions' => [
                'grouped_permissions' => '分组权限',
                'ungrouped_permissions' => '未分组权限',
                'no_ungrouped'    => '无未分组权限',
                'management'    => '权限管理',
                'label' => '权限',
                'groups'    => [
                    'create' => '创建权限组',
                    'edit' => '编辑权限组',
                    'table'=>[
                        'name' => '权限组组名',

                    ]
                ],
                'tabs'=>[
                    'groups' => '权限组列表',
                    'permissions' => '权限列表'
                ],
                'table' =>[
                    'permission' => '权限码',
                    'name' => '权限名',
                    'dependencies' => '依赖权限',
                    'users' => '关联用户',
                    'roles' => '关联角色',
                    'group' => '所属组',
                    'group-sort' => '排序',
                    'system' => '系统权限',
                    'actions' => '操作',
                    'total' => '总计',
                ],
            ],
        ],
        'auth' => [
            'login_box_title' => '登录',
            'login_button' => '登录',
            'remember_me' => '记住我',
        ],
        'passwords' => [
            'forgot_password' => '亲, 忘记密码了吗?',
            'reset_password_box_title' => '重置密码',
            'reset_password_button' => '确定',
            'send_password_reset_link_button' => '发送重置密码链接',
        ],
    ],
    'general' => [
        'actions' => '操作',
        'custom' => '自定义',
        'none' => '无',
        'show' => '显示',
        'hide' => '隐藏',
        'all' => '全部',
        'yes' => '是',
    ],
];