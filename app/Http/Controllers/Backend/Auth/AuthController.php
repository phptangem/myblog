<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Access\User\EloquentUserRepository;
use App\Services\Access\Traits\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/backend/dashboard';
    protected $loginView  = 'backend.auth.login';
    protected $redirectPath  ;
    protected $redirectAfterLogout;
    protected $user;

    /**
     * AuthController constructor.
     * @param EloquentUserRepository $user
     */
    public function __construct(EloquentUserRepository $user)
    {
        $this->user                 = $user;
        $this->redirectPath         = route('backend.dashboard');
        $this->redirectAfterLogout  = route('backend.auth.login');
    }

}
