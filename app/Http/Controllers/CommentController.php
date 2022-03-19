<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Notif;
use DB;

class CommentController extends Controller
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
        $id = $request->input('post_id_temp');
        $find_postid = Post::find($id);
        $post = new Comment;
        $post -> commentUserId = auth()->user()->id;
        $post -> commentPostId = $find_postid->postId;
        $post -> commentDescription = $request->input('comment');
        $post->save();

        $touserid = $request->input('likeuserid');
        $post3 = new Notif;
        $post3 -> notifUserId = auth()->user()->id;
        $post3 -> notifToUserId = $touserid;
        $post3 -> notifPostId = $id;
        $post3 -> notifType = "commented";
        $post3 -> notifStatus = "UNREAD";
        $post3->save();

        $posts = DB::select('SELECT * FROM posts JOIN users on posts.postUserId = users.id ORDER BY posts.postUpdatedAt DESC');
        return redirect()->back()->with('posts', $posts);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        $this -> validate($request,[
            'description' => 'required',
         ]);
        
         $postid = $request->input('post_id');
         $post = Comment::find($id);
         $post -> commentDescription = $request->input('description');
         $post->save();
   
         return redirect()->back()->with('success', 'Comment updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $postid = $request->input('post_id');
        $post = Comment::find($id);
        $post->delete();
        DB::table('reports')->where(['reportCommentId'=> $id])->delete();
        return redirect('/home/'.$postid)->with('success', 'Comment removed.');
    }
}
