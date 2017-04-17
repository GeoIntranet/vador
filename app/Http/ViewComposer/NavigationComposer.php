<?php

namespace App\Http\ViewComposer;

use App\Http\Controllers\Lib\Gestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\View\View;
use Carbon\Carbon;

class NavigationComposer extends Gestion
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $user = Auth::user();
        $admin = $user->USER_type >= 6 ?  'admin' : 'noAdmin' ;
        $avatar = $user->USER_icone;

        $range = collect(Redis::ZREVRANGE('incident_pref_user'.$user->id,0,9));

        $avatar_ =collect([]);
        foreach ($range as  $item)
        {
            $avatar__ = isset($this->avatars[$item]) ? $this->avatars[$item].'.png':'NC.png';
            $avatar_[$item] = $avatar__;
        }

        $incidents = unserialize(Redis::get('incident.all.last'));

        $view
            -> with('admin',$admin)
            -> with('avatar',$avatar)
            -> with('avatar_',$avatar_)
            -> with('incidents_redis',$incidents)

        ;
    }
}