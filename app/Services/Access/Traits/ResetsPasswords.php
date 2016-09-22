<?php
namespace App\Services\Access\Traits;

use App\Http\Requests\Backend\SendResetLinkEmailRequest;

trait ResetsPasswords
{
    public function showLinkRequestForm()
    {
        return view('backend.auth.passwords.email');
    }

    /*
    * 作用:重置密码视图
    * 参数:token 重置授权码
    *
    * 返回值:
    */
    public function showResetForm($token = null)
    {
        if(is_null($token)){

            return $this->showLinkRequestForm();
        }
    }

    /*
    * 作用:发送重置密码链接
    * 参数:email 邮箱地址
    *
    * 返回值:
    */
    public function sendResetLinkEmail(SendResetLinkEmailRequest $request)
    {

    }
}