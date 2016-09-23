<?php

namespace App\Http\Requests\Backend\Auth;

use App\Http\Requests\Request;

class LoginRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'email' => '邮箱',
            'password' => '密码',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute必填',
            'email' =>'邮箱必填',
        ];
    }
}
