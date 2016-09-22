<?php
namespace App\Services\Access\Traits;

use App\Http\Requests\Backend\Auth\ResetRequest;
use App\Http\Requests\Backend\Auth\SendResetLinkEmailRequest;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;
trait ResetsPasswords
{
    use RedirectsUsers;
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

        return view('backend.auth.passwords.reset')
            ->with('token', $token);
    }

    /*
    * 作用:发送重置密码链接
    * 参数:email 邮箱地址
    *
    * 返回值:
    */
    public function sendResetLinkEmail(SendResetLinkEmailRequest $request)
    {
        $response = Password::sendResetLink($request->only('email'), function(Message $message){
            $message->subject(trans('strings.emails.auth.password_reset_subject'));
        });
        switch($response){
            case Password::RESET_LINK_SENT:
                return redirect()->back()->with('status', trans($response));
            case Password::INVALID_USER:
                return redirect()->back()->withErrors(['email' => trans($response)]);
        }
    }
    
    /*作用:重置密码
    *参数:
    *返回值:
    */
    public function reset(ResetRequest $request)
    {
        $credentials = $request->only(
            'email','password','password_confirmation','token'
        );
        $response = Password::reset($credentials, function($user, $password){
            $this->resetPassword($user, $password);
        });
        switch($response){
            case Password::PASSWORD_RESET:
                return redirect($this->redirectPath())->with('status', trans($response));
            default:
                return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email'=>trans($response)]);
        }
    }

    /*作用:密码重置
    *参数:
    *返回值:
    */
    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);
        $user->save();
        auth()->login($user);
    }
}