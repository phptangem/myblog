<?php
namespace App\Services\Access\Traits;

use App\Events\Backend\Auth\UserLoggedIn;
use App\Events\Backend\Auth\UserLoggedOut;
use App\Exceptions\GeneralException;
use App\Http\Requests\Backend\Auth\LoginRequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

trait AuthenticatesUsers
{
    use RedirectsUsers;
    /*
    * 作用:展示登陆页
    * 参数:
    * 
    * 返回值:
    */
    public function showLoginForm()
    {
        return view('backend.auth.login');
    }
    /*
    * 作用:登陆
    * 参数:
    * 
    * 返回值:
    */
    public function login(LoginRequest $request)
    {
        $throttles = in_array(
            ThrottlesLogins::class, class_uses_recursive(get_class($this))
        );
        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }
        if (auth()->attempt($request->only($this->loginUsername(), 'password'), $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect()->back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => trans('auth.failed'),
            ]);
    }
    /*
    * 作用:登出
    * 参数:
    *
    * 返回值:
    */
    public function logout()
    {
        /**
         * Remove the socialize session variable if exists
         */
        if(app('session')->has(config('access.socialite_session_name'))){
            app('session')->forget(config('access.socialite_session_name'));
        }
        event(new UserLoggedOut(access()->user()));
        auth()->logout();
        return redirect(property_exists($this,'redirectAfterLogout') ? $this->redirectAfterLogout : route('backend.auth.login'));
    }
    /*
    * 作用:traits throttles 使用
    * 参数:
    * 
    * 返回值:
    */
    public function loginUsername()
    {
        return 'email';
    }
    /*
    * 作用:登陆成功后的操作
    * 参数:
    *
    * 返回值:
    */
    protected function handleUserWasAuthenticated(Request $request,$throttles)
    {
        if($throttles){
            $this->clearLoginAttempts($request);
        }
        /**
         * Check to see if the users account is confirmed and active
         */
        if(! access()->user()->isConfirmed()){
            $id = access()->user()->id;
            auth()->logout();
            throw new GeneralException(trans('exceptions.backend.auth.confirmation.resend',['uid'=>$id]));
        }
        if(! access()->user()->isActive()){
            auth()->logout();
            throw new GeneralException(trans('exceptions.backend.auth.deactivated'));
        }
        event(new UserLoggedIn(access()->user()));
        return redirect()->intended($this->redirectPath());
    }


}
