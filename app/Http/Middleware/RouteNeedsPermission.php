<?php

namespace App\Http\Middleware;

use Closure;

class RouteNeedsPermission
{
    /**
     * @param $request
     * @param Closure $next
     * @param $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $permission)
    {
        if(! access()->allow($permission)){
            return redirect()
                ->route('frontend.index')
                ->withFlashDanger(trans('auth.general_error'));
        }
        return $next($request);
    }
}
