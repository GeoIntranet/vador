<?php

namespace App\Http\Middleware;

use App\Horaire;
use App\Http\Controllers\Lib\Horaire\HoraireGestion;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class HoraireUpToDate
{
    protected $user;
    protected $time;
    protected $horaireGestion;

    /**
     * HoraireUpToDate constructor.
     * @param $auth
     */
    public function __construct(Auth $auth , Horaire $time , HoraireGestion $horaireGestion)
    {
        $this->user = $auth::user()->id;
        $this->time = $time;
        $this->horaireGestion = $horaireGestion;
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

        $isAvailableDate = $this->horaireGestion->DayOuvrable();

        return $next($request);
    }
}
