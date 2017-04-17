<?php

namespace App\Http\Middleware;


use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TrackingRouteUser
{
    protected $user;
    /**
     * TrackingRouteUser constructor.
     */
    public function __construct(Auth $auth )
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
        $key = 'TrackingRoute_'.$this->user.'_'.Carbon::now()->timestamp;
        Cache::forever($key , $request->url());
        
        return $next($request);
    }
}
