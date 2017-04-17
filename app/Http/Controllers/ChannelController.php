<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;

use App\Http\Requests;

class ChannelController extends Controller
{
    public function create()
    {
        return view('forum.channel.create');
    }

    public function store(Request $request)
    {
       if($request->channel <> '')
       {
           $channel = new Channel();
           $channel->name = $request->channel;
           $channel->slug = $request->channel;
           $channel->save();
       }

       return redirect()->action('ThreadController@index',[null]);
    }
}
