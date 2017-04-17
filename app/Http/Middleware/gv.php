<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class gv
{
    public function __construct(Auth $auth)
    {
        $this->user = $auth::user()->id;

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $autorize = (($this->user == 48) or( $this->user == 56 )) ? TRUE : FALSE;


       if($autorize == TRUE)
       {
           return $next($request);
       }
        else{
            return response()->json([
                'page adminsitration'
            ]);
        }


    }
}
