<?php

return [
    'backend' => [
        'access' =>[
            'users' => [
                'management' => '用户管理',
                'active' => '正常用户',
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
        'none' => '无',
    ],
];