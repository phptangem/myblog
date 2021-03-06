<?php
return [
    'backend' =>[
        'access'=>[
            'users' => [
                'cant_deactivate_self' =>'不能禁用自己',
                'mark_error' => '更新异常，请重试!',
                'create_error' => '用户创建失败，请重试!',
                'cant_delete_self' => '不能删除自己',
                'delete_error' => '删除异常',
                'email_error' => '该邮箱已经存在!',
                'update_error' => '更新失败,请重试',
                'role_needed_create' => '请选择用户绑定角色',
                'update_password_error' => '修改密码失败，请重试!',
                'restore_error' => '恢复失败,请重试!',
            ],
        ],
        'auth' => [
            'confirmation' => [
                'already_confirmed' => '账户已经激活,请勿重复操作',
                'confirm' => '账号激活',
                'resend' => '您的账号还未验证，请查看前往您的邮箱进行验证，或者<a href="'.route('backend.account.confirm.resend',':uid').'">点击这里</a>发送验证邮件',
                'not_found' => '激活码错误',
            ],
            'deactivated' => '您的账号已经被禁用',
        ],
    ]
];