<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class RepliesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($channelId,Thread $thread)
    {
        $this->validate(request(),[
           'body'=>'required',
        ]);
       $reply= $thread->addReply([
            'body'=>\request('body'),
            'user_id'=> auth()->id(),
        ]);

        if (\request()->expectsJson()){
            return $reply->load('owner');
        }

        return back()->with('flash','your reply is here!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply  $Reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $Reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reply  $Reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $Reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $Reply
     * @return \Illuminate\Http\Response
     */
    public function update(Reply $reply)
    {
        $this->authorize('update',$reply);
        $reply->update(request()->all());
        if (request()->expectsJson()){
            return response(['status'=>'Reply deleted']);
        }
        return back()->with('flash','updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $Reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $Reply)
    {
        $this->authorize('update',$Reply);
        $Reply->delete();
        return back()->with('flash','comment has gone for good');
    }
}
