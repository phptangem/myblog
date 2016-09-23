<?php
namespace App\Services\Access\Traits;

use Illuminate\Foundation\Auth\RegistersUsers;

trait AuthenticatesAndRegistersUsers
{
    use AuthenticatesUsers,RegistersUsers{
        AuthenticatesUsers::redirectPath insteadof RegistersUsers;
    }
}