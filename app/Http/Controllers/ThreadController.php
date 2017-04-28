<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Lib\Filter\ThreadFilter;
use Golonka\BBCode\Facades\BBCodeParser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Channel;
use App\Thread;

class ThreadController extends Controller
{
    protected $admin;

    /**
     * ThreadController constructor.
     * @param $admin
     */
    public function __construct()
    {

    }


    public function index(ThreadFilter $filter, $channel = null )
    {

        $threads = $this->getThreads($channel,$filter);

        return view('forum.index')
            ->with('threads',$threads)
            ;
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id'
        ]);

        $thread = Thread::create([
            'user_id' => auth()->id(),
            'channel_id' => request('channel_id'),
            'active' => 1,
            'title' => request('title'),
            'body' =>  request('body')
        ]);

        return redirect()->action('ThreadController@index',null);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function create()
    {
        return view('forum.thread.create');
    }

    /**
     * @param $channelId
     * @param Thread $thread
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($channelId, Thread $thread)
    {
        return view('forum.thread.show', [
            'thread' => $thread,
            'replies' => $thread->replies()->with('owner')->orderBy('created_at','DESC')->paginate(20)
        ]);
    }

    /**
     * @param $channel
     * @param ThreadFilter $filter
     * @return mixed
     */
    private function getThreads($channel , ThreadFilter $filter)
    {

        $threads = Thread::latest()
          //  ->filter($filter)
        ;

        if($channel == null)
        {
            return Thread::OrderBy('created_at','DESC')
                ->active()
                ->with('createur')
                ->get()
                ;
        }
        else{
            return Thread::Where('channel_id',$channel)
                ->active()
                ->with('createur')
                ->OrderBy('created_at','DESC')
                ->get()
                ;
        }
    }

    /**
     * @param $channel
     * @param Thread $thread
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($channel , Thread $thread)
    {
        $channels_ = Channel::all()->pluck('name','id');

        return view('forum.thread.edit', [
            'thread' => $thread,
            'replies' => $thread->replies()->with('owner')->orderBy('created_at','DESC')->paginate(20),
            'channels_' => $channels_
        ]);
    }

    /**
     * @param Request $request
     * @param Thread $thread
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request , Thread $thread)
    {
        $validate = $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id'
        ]);


       $thread->update([
           'channel_id' => request('channel_id'),
           'title' => request('title'),
           'body' =>  request('body')
        ]);

        return redirect()->action('ThreadController@show',[request('channel_id'),$thread->id]);
    }

    /**
     * @param $Channel
     * @param Thread $thread
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disableThread($Channel,Thread $thread)
    {
        if ($this->havePermissionForDisable($thread))
            $thread->update(['active' => 0]);

        return redirect()->action('ThreadController@index', $Channel);
    }

    /**
     * @param Thread $thread
     * @return bool
     */
    private function havePermissionForDisable(Thread $thread)
    {
        return $thread->user_id == Auth::id() or $this->admin == Auth::id();
    }

}
