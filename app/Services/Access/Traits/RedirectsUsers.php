<?php
namespace App\Services\Access\Traits;

trait RedirectsUsers
{

    public function redirectPath()
    {
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }
}