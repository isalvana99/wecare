<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\Post;
use App\Models\Notif;

class FollowController extends Controller
{
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
    public function store(Request $request)
    {
        $postid = $request->input('followpostid');
        
        $post2 = Post::join('users', 'users.id', '=', 'posts.postUserId')
                    ->where('postId', $postid)
                    ->first();

        $post = new Follow;
        $post -> followUserId = auth()->user()->id;
        $post -> followedUserId = $post2->postUserId;
        $post->save();

        $post3 = new Notif;
        $post3 -> notifUserId = auth()->user()->id;
        $post3 -> notifToUserId = $post2->postUserId;
        $post3 -> notifPostId = $postid;
        $post3 -> notifType = "followed";
        $post3 -> notifStatus = "UNREAD";
        $post3->save();

        return redirect()->back();
    }

    public function store2(Request $request)
    {
        $postid = $request->input('followpostid');
        $userid = "";
        //$user = DB::select('SELECT * FROM users WHERE id = '.$postid);

        $post2 = Post::join('users', 'users.id', '=', 'posts.postUserId')
                    ->get();

        if(count($post2) > 0) {
            foreach($post2 as $a){
                if($a->postId == $postid)
                {
                    $userid = $a->postUserId;
                    
                }
            }
        }

        $post = new Follow;
        $post -> followUserId = auth()->user()->id;
        $post -> followedUserId = $postid;
        $post->save();

        $post3 = new Notif;
        $post3 -> notifUserId = auth()->user()->id;
        $post3 -> notifToUserId = $postid;
        $post3 -> notifType = "followed";
        $post3 -> notifStatus = "UNREAD";
        $post3->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $follow = Follow::find($id);
        $follow -> delete();
        return redirect()->back();
    }
}
