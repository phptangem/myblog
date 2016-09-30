<?php

return [
    'backend' => [
        'access' => [
            'users' => [
                'delete_user_confirm' => '本操作将永久删除此用户，无法恢复，请慎重考虑!',
                'restore_user_confirm' => '恢复此用户到正常状态',
            ],
            'permissions' => [
                'sort_explanation' => '拖动图标来调整权限组的上下级关系',
                'edit_explanation' => '编辑权限组',
            ],
        ],
        'general' => [
            'all_rights_reserved' => 'All Rights Reserved',
            'are_you_sure' =>'亲,请谨慎操作哟？',
            'continue' => '确定',
            'status' => [
                'online' => '在线',
            ],
            'search_placeholder' => '搜索',
        ]
    ],
    'emails' => [
        'auth' => [
            'password_reset_subject' => '密码重置',
        ],
        'account_confirm' => '激活账号',
        'reset_password' => '点击此链接重置密码',
    ],
];