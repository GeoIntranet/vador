<?php

namespace App\Http\Middleware;

use Closure;

class AccesibleRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( ! $this->isAccesible())
        {
            return redirect()->to('/logout');
        }
        return $next($request);
    }


    public function isAccesible()
    {
        return TRUE;
    }


}
