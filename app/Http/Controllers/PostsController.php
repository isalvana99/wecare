<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use App\Models\PostReactions;
use App\Models\Comment;
use App\Models\Review;
use App\Models\Notif;
use DB;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //to display in ascending list
      //$posts = Post::orderBy('title','asc')->get();

      //to display in descending list
      //$posts = Post::orderBy('title','asc')->get();

      //to display using database
      //$posts = DB::select('SELECT * FROM posts JOIN users on posts.postUserId = users.id ORDER BY posts.postUpdatedAt DESC');

      //$posts = Post::all();
      $posts = DB::select('SELECT * FROM posts JOIN users on posts.postUserId = users.id ORDER BY posts.postUpdatedAt DESC');
      $posts2 = DB::select('SELECT * FROM posts JOIN users on posts.postUserId = users.id ORDER BY posts.postCreatedAt DESC LIMIT 10');
      $user = DB::select('SELECT * FROM users WHERE role = "USER" AND id != '.auth()->user()->id.' ORDER BY accountCreatedAt DESC LIMIT 10');
      $comment = DB::select('SELECT * FROM comments');
      $likes2 = DB::select('SELECT * FROM likes');
      $shares = DB::select('SELECT * FROM shares');
      $follows = DB::select('SELECT * FROM follows');
      $notification = DB::select('SELECT * FROM notifs JOIN users ON users.id = notifs.notifUserId WHERE notifToUserId =' .auth()->user()->id.' ORDER BY notifCreatedAt DESC LIMIT 50');
      $search = "";
      $search = $request->input('search');
      if(auth()->user()->role == "ADMIN")
      {
        return view('admin.adminhome')->with('posts', $posts);
      }

      return view('pages.home', compact('posts', 'notification', 'posts2', 'user', 'comment', 'likes2', 'shares', 'follows', 'search'));
    }

    public function userLayout(Request $request)
    {
        return view('layouts.user_layout');
    }

    public function index2()
    {
      //to display in ascending list
      //$posts = Post::orderBy('title','asc')->get();

      //to display in descending list
      //$posts = Post::orderBy('title','asc')->get();

      //to display using database
      //$posts = DB::select('SELECT * FROM posts JOIN users on posts.postUserId = users.id ORDER BY posts.postUpdatedAt DESC');

      //$posts = Post::all();
      $posts = DB::select('SELECT * FROM posts JOIN users on posts.postUserId = users.id ORDER BY posts.postUpdatedAt DESC');
      $user = DB::select('SELECT * FROM users WHERE role = "USER" AND id != '.auth()->user()->id.' ORDER BY accountCreatedAt DESC LIMIT 3');
      $comment = DB::select('SELECT * FROM comments');
      //$likes = DB::select('SELECT * FROM likes WHERE likeUserId = ' .auth()->user()->id);
      $likes2 = DB::select('SELECT * FROM likes');
      $shares = DB::select('SELECT * FROM shares');
      $follows = DB::select('SELECT * FROM follows');
      // $posts = DB::table('posts')
      //         ->join('users', 'users.id', '=', 'posts.postUserId')
      //         ->join('likes', 'likes.likeUserId', '=', 'users.id')
      //         ->orderBy('postUpdatedAt', 'DESC')
      //         ->get();

      //$posts = Post::all();
      if(auth()->user()->role == "ADMIN")
      {
        return view('admin.adminhome')->with('posts', $posts);
      }

      return view('pages.home2', compact('posts', 'user', 'comment', 'likes2', 'shares', 'follows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request,[
          'caption' => 'required',
          'cover_image' => 'image|required|max:1999',
          'amountTarget' => 'required',
        ]);

        //handles the file upload
        if($request->hasFile('cover_image')){
          //get filename with extension
          $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
          //get just filename
          $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
          //get just ext
          $extension = $request->file('cover_image')->getClientOriginalExtension();
          //filename to Store
          $fileNameToStore = $filename .'_'.time().'.'.$extension;
          //upload image
          $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore );
        }else{
          $fileNameToStore = 'noimage.jpg';
        }
        
        $postid = random_int(100000000000, 999999999999)."0";
        $post = new Post;
        $post -> postId = $postid;
        $post -> postCaption = $request->input('caption');
        $post -> postTargetAmount = $request->input('amountTarget');
        $post -> postLikes = "0";
        $post -> postStatus = "PROCESS";
        $post -> postUserId = auth()->user()->id;
        $post -> postCategory = $request->input('category');
        $post -> postRegion = $request->input('region');
        $post -> postProvince = $request->input('province');
        $post -> postCity = $request->input('city');
        $post -> postBarangay = $request->input('barangay');
        $post -> postSector = $request->input('sector');
        $post -> postCoverImage = $fileNameToStore;
        $post->save();

        return redirect()->back()->with('success', 'Great! Post created successfully!');
    }

    public function storeFromTimeline(Request $request)
    {
        $this -> validate($request,[
          'caption' => 'required',
          'cover_image' => 'image|nullable|max:1999'
        ]);

        //handles the file upload
        if($request->hasFile('cover_image')){
          //get filename with extension
          $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
          //get just filename
          $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
          //get just ext
          $extension = $request->file('cover_image')->getClientOriginalExtension();
          //filename to Store
          $fileNameToStore = $filename .'_'.time().'.'.$extension;
          //upload image
          $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore );
        }else{
          $fileNameToStore = 'noimage.jpg';
        }

        $post = new Post;
        $post -> postCaption = $request->input('caption');
        $post -> postTargetAmount = $request->input('amountTarget');
        $post -> postUserId = auth()->user()->id;
        $post -> postLikes = "0";
        $post -> postCoverImage = $fileNameToStore;
        $post->save();

        return redirect('/users/profile/'.$post->postUserId)->with('success', 'Post created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
      $search = "";
      $search = $request->input('search');

      $comment = DB::select('SELECT * FROM comments');
      $likes2 = DB::select('SELECT * FROM likes');
      $shares = DB::select('SELECT * FROM shares');
      $follows = DB::select('SELECT * FROM follows');
      $post = Post::join('users', 'users.id', '=', 'posts.postUserId')
                    ->where('postId', $id)
                    ->first();
      $var_com = "COMMENT";
      

      $postreaction = Comment::query()
                     ->join('users', 'users.id', '=', 'comments.commentUserId')
                     ->where('comments.commentPostId', $id)
                     ->orderBy('comments.commentCreatedAt', 'DESC')
                     ->get();

      $transaction = "SELECT * FROM transactions JOIN posts ON transactions.transactionPostId = ".$id;
      
      $notification = DB::select('SELECT * FROM notifs JOIN users ON users.id = notifs.notifUserId WHERE notifToUserId =' .auth()->user()->id.' ORDER BY notifCreatedAt DESC LIMIT 50');

      return view('posts.show', compact('notification','comment', 'likes2', 'shares', 'follows', 'post', 'var_com', 'postreaction', 'search'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $posts = Post::find($id);
      if(auth()->user()->id !== $posts->postUserId){
        return redirect('/home')->with('error', 'Unauthorized page.');
      }else{
        return view('posts.edit')->with('posts', $posts);
      }
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
         'caption' => 'required',
        // 'cover_image' => 'image|nullable|max:1999'
      ]);

      //handles the file upload
      // if($request->hasFile('cover_image')){
      //   //get filename with extension
      //   $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
      //   //get just filename
      //   $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      //   //get just ext
      //   $extension = $request->file('cover_image')->getClientOriginalExtension();
      //   //filename to Store
      //   $fileNameToStore = $filename .'_'.time().'.'.$extension;
      //   //upload image
      //   $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore );
      // }

      $post = Post::find($id);
      $post -> postCaption = $request->input('caption');
      // if($request->hasFile('cover_image')){
      //   $post->cover_image = $fileNameToStore;
      // }
      $post->save();

      return redirect('/home/'.$id)->with('success', 'Post successfully updated.');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id != $post->postUserId){
          return redirect('/home')->with('error', 'Unauthorized page.');
        }

        //to delete also the photo
        if($post->postCoverImage != 'noimage.jpg'){
          Storage::delete('public/cover_images/'.$post->postCoverImage);
        }

        //deleting post
        // $d_comment = DB::select('SELECT * FROM comments WHERE commentPostId =' .$id);
        // foreach($d_comment as $v){
          
        // }

        DB::table('comments')->where(['commentPostId'=> $id])->delete();
        DB::table('likes')->where(['likePostId'=> $id])->delete();
        DB::table('recactivities')->where(['recactivityPostId'=> $id])->delete();
        DB::table('reports')->where(['reportPostId'=> $id])->delete();
        DB::table('transactions')->where(['transactionPostId'=> $id])->delete();

        $post->delete();
        return redirect()->back()->with('success', 'Post successfully removed.');

    }

    public function search(Request $request){
      // Get the search value from the request
      $search = "";
      $search = $request->input('search');
  
      // Search in the title and body columns from the posts table
      $posts = Post::query()
          ->join('users', 'users.id', '=', 'posts.postUserId')
          ->where('postCaption', 'LIKE', "%{$search}%")
          ->orWhere('orgName', 'LIKE', "%{$search}%")
          ->orWhere('firstName', 'LIKE', "%{$search}%")
          ->orWhere('middleName', 'LIKE', "%{$search}%")
          ->orWhere('lastName', 'LIKE', "%{$search}%")
          ->orWhere('postCategory', 'LIKE', "%{$search}%")
          ->orWhereRaw(
            "concat(firstName, ' ', middleName, ' ', lastName) like '%" . $search . "%' ")
          ->orWhereRaw(
                "concat(firstName, ' ', lastName) like '%" . $search . "%' ")
          ->orderBy('postUpdatedAt', 'DESC')
          ->get();

      $searchusers = User::query()
          ->where('role', '!=', "ADMIN")
          ->where('orgName', 'LIKE', "%{$search}%")
          ->orWhere('firstName', 'LIKE', "%{$search}%")
          ->orWhere('middleName', 'LIKE', "%{$search}%")
          ->orWhere('lastName', 'LIKE', "%{$search}%")
          ->orWhereRaw(
            "concat(firstName, ' ', middleName, ' ', lastName) like '%" . $search . "%' ")
          ->orWhereRaw(
            "concat(firstName, ' ', middleName) like '%" . $search . "%' ")
          ->orWhereRaw(
            "concat(middleName, ' ', lastName) like '%" . $search . "%' ")
          ->orWhereRaw(
                "concat(firstName, ' ', lastName) like '%" . $search . "%' ")
          ->orderBy('accountCreatedAt', 'DESC')
          ->get();

      //$posts = DB::select('SELECT * FROM posts JOIN users on posts.postUserId = users.id ORDER BY posts.postUpdatedAt DESC');
      $user = DB::select('SELECT * FROM users WHERE role = "USER" AND id != '.auth()->user()->id.' ORDER BY accountCreatedAt DESC LIMIT 30');
      $comment = DB::select('SELECT * FROM comments');
      //$likes = DB::select('SELECT * FROM likes WHERE likeUserId = ' .auth()->user()->id);
      $likes2 = DB::select('SELECT * FROM likes');
      $shares = DB::select('SELECT * FROM shares');
      $follows = DB::select('SELECT * FROM follows');

      //$posts = DB::select('SELECT * FROM posts JOIN users on posts.postUserId = users.id ORDER BY posts.postUpdatedAt DESC');
      $posts2 = DB::select('SELECT * FROM posts JOIN users on posts.postUserId = users.id ORDER BY posts.postUpdatedAt DESC LIMIT 10');
      
      $notification = DB::select('SELECT * FROM notifs JOIN users ON users.id = notifs.notifUserId WHERE notifToUserId =' .auth()->user()->id.' ORDER BY notifCreatedAt DESC LIMIT 50');
      // Return the search view with the resluts compacted
      return view('posts.search', compact('notification','searchusers','posts', 'posts2', 'user', 'comment', 'likes2', 'shares', 'follows', 'search'));
    }

    public function settingsTopNav(){
      return view('users.my_user_settings');
    }

    

    public function method(Request $request) {
      // Do your stuff with the request..
      
      return response()->json(['return' => 'some data']);
    }

    public function thisnotif(Request $request){
      $var = $request->input('me');
      $n = DB::select('SELECT * FROM notifs WHERE notifToUserId = '.auth()->user()->id);
      if(count($n)>0){
          foreach($n as $a){
              $post = Notif::find($a->notifId);
              $post -> notifStatus = "READ";
              $post->save();
          }
      }
      
      return redirect()->back();
  }
}
