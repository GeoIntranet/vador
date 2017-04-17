<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Golonka\BBCode\Facades\BBCodeParser;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{
    public function store($channelId, Thread $thread)
    {
        $this->validate(request(), ['body' => 'required']);
        $body = BBCodeParser::parse(request('body'));


        $thread->addReply([
        'body' => $body,
        'active' => 1,
        'user_id' => auth()->id()
        ]);
        return back();
    }

    public function toggleWriteMode()
    {
        session()->flash('forum_edit_thread',TRUE);
        return redirect()->back();
    }

    public function disableReply(Reply $reply)
    {
        if( $reply->user_id == Auth::id() )
        {
            $reply->update([
                'active'=>0
            ]);
        }

        return redirect()->back();
    }
}
