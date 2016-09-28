<?php

namespace App\Http\Requests\Backend\Access\User;

use App\Http\Requests\Request;

class StoreUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                      =>  'required',
            'email'                     =>  'required|email|unique:users',
            'password'                  =>  'required|min:6|confirmed|alpha_num',
            'password_confirmation'     =>  'required|min:6|alpha_num'
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'name'                  => '昵称',
            'email'                 => '邮箱',
            'password'              => '密码',
            'password_confirmation' => '确认密码',
        ];

    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'required'      => ':attribute必填',
            'email'         => ':attribute格式错误',
            'unique'        => ':attribute已存在',
            'confirmed'     => ':attribute不一样',
            'alpha_num'     => ':attribute必须为字母和数字',
            'min'           => ':attribute长度必须6位以上',
        ];
    }
}
