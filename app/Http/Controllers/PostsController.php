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
use App\Models\Transaction;
use App\Models\Transparency;
use App\Models\File;
use App\Models\Postimages;
use App\Models\Distribution;
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
      $posts = DB::select('SELECT * FROM posts JOIN users on posts.postUserId = users.id JOIN postimages ON posts.postId = postimages.postImagePostId ORDER BY posts.postUpdatedAt DESC');
      $posts2 = DB::select('SELECT * FROM posts JOIN users on posts.postUserId = users.id JOIN postimages ON posts.postId = postimages.postImagePostId ORDER BY posts.postCreatedAt DESC LIMIT 10');
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
      $posts = DB::select('SELECT * FROM posts JOIN users on posts.postUserId = users.id JOIN postimages ON posts.postId = postimages.postImagePostId ORDER BY posts.postUpdatedAt DESC');
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
        $post -> postUserId = auth()->user()->id;
        $post -> postCategory = $request->input('category');
        $post -> postRegion = $request->input('region');
        $post -> postProvince = $request->input('province');
        $post -> postCity = $request->input('city');
        $post -> postBarangay = $request->input('barangay');
        $post -> postSector = $request->input('sector');
        //$post -> postCoverImage = $fileNameToStore;
        $post->save();

        $post2 = new Postimages;
        $post2 -> postImagePostId = $postid;
        $post2 -> postImageUserId = auth()->user()->id;
        $post2 -> postImageName = $fileNameToStore;
        $post2->save();


        return redirect()->back()->with('success', 'Great! Post created successfully!');
    }

    public function stopDonation(Request $request){
      $id = $request->input('postid');
      $posts = Post::find($id);
      $posts -> postStatus = "STOPPED";
      $posts -> save();
      return redirect()->back();
    }

    public function goDonation(Request $request){
      $id = $request->input('postid');
      $posts = Post::find($id);
      $posts -> postStatus = "PROCESS";
      $posts -> save();
      return redirect()->back();
    }

    public function storeFromTimeline(Request $request)
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
      $post -> postUserId = auth()->user()->id;
      $post -> postCategory = $request->input('category');
      $post -> postRegion = $request->input('region');
      $post -> postProvince = $request->input('province');
      $post -> postCity = $request->input('city');
      $post -> postBarangay = $request->input('barangay');
      $post -> postSector = $request->input('sector');
      //$post -> postCoverImage = $fileNameToStore;
      $post->save();

      $post2 = new Postimages;
      $post2 -> postImagePostId = $postid;
      $post2 -> postImageUserId = auth()->user()->id;
      $post2 -> postImageName = $fileNameToStore;
      $post2->save();

        return redirect()->back()->with('success', 'Post created.');
    }

    public function storeFromTimeline2(Request $request)
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
      $post -> postUserId = $request->input('owneruserid');
      $post -> postUser2Id = auth()->user()->id;
      $post -> postCategory = $request->input('category');
      $post -> postRegion = $request->input('region');
      $post -> postProvince = $request->input('province');
      $post -> postCity = $request->input('city');
      $post -> postBarangay = $request->input('barangay');
      $post -> postSector = $request->input('sector');
      //$post -> postCoverImage = $fileNameToStore;
      $post->save();

      $post2 = new Postimages;
      $post2 -> postImagePostId = $postid;
      $post2 -> postImageUserId = auth()->user()->id;
      $post2 -> postImageName = $fileNameToStore;
      $post2->save();

      
        return redirect()->back()->with('success', 'Post created.');
    }

    public function repost(Request $request){

      $id = $request->input('postid');
      $user = $request->input('userid');
      $posts = Post::find($id);
      $posts -> postUser2Id = "REPOST";
      $posts -> save();

      return redirect('/users/profile2/'.$user);
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
      $l = "";
      $l = $request->input('l');

      $comment = DB::select('SELECT * FROM comments');
      $likes2 = DB::select('SELECT * FROM likes');
      $shares = DB::select('SELECT * FROM shares');
      $follows = DB::select('SELECT * FROM follows');
      $post = Post::join('users', 'users.id', '=', 'posts.postUserId')
                    ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                    ->where('postId', $id)
                    ->first();
      $var_com = "COMMENT";
      

      $postreaction = Comment::query()
                     ->join('users', 'users.id', '=', 'comments.commentUserId')
                     ->where('comments.commentPostId', $id)
                     ->orderBy('comments.commentCreatedAt', 'DESC')
                     ->get();

      $transaction =  Transaction::join('users', 'users.id', '=', 'transactions.transactionUserId')
                    ->where('transactionPostId', $id)
                    ->orderBy('transactionCreatedAt', 'DESC')
                    ->get();
      
      $transparency = Transparency::query()->join('users', 'users.id', '=', 'transparencies.transparencyHouseholdUserId')->orderBy('transparencyLocation', 'ASC')->where('transparencyPostId', '=', $id)->get();

      $files = File::query()->orderBy('fileCreatedAt', 'DESC')->where('filePostId', '=', $id)->get();
      
      $notification = DB::select('SELECT * FROM notifs JOIN users ON users.id = notifs.notifUserId WHERE notifToUserId =' .auth()->user()->id.' ORDER BY notifCreatedAt DESC LIMIT 50');

      return view('posts.show', compact('notification','comment', 'likes2', 'shares', 'follows', 'post', 'var_com', 'postreaction', 'search', 'transaction', 'l', 'transparency', 'files'));
    }

    public function showDistribution(Request $request)
    {
      $search = "";
      $l = "";
      $l = $request->input('l');
      $search = $request->input('search');
      $postid = $request->input('postid');

      $post = Post::join('users', 'users.id', '=', 'posts.postUserId')
                    ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                    ->where('postId', $postid)
                    ->first();
      
      $transparency = Transparency::query()->orderBy('transparencyLocation', 'ASC')->where('transparencyPostId', '=', $postid)->get();

      //mandaue
      $b1 = array('Alang-alang', 'Bakilid', 'Banilad', 'Basak', 'Cabancalan', 'Cambaro', 'Canduman', 'Casili', 'Casuntingan', 'Centro', 'Cubacub', 'Guizo', 'Ibabao-Estancia', 'Jagobiao', 'Labogon', 'Looc', 'Maguikay', 'Mantuyong', 'Opao', 'Pakna-an', 'Pagsabungan', 'Subangdaku', 'Tabok', 'Tawason', 'Tingub', 'Tipolo', 'Umapad');
      //lapu-lapu
      $b2 = array('Agus', 'Babag', 'Bankal', 'Baring', 'Basak', 'Buaya', 'Calawisan', 'Canjulao', 'Caw-oy', 'Cawhagan', 'Caubian', 'Gun-ob', 'Ibo', 'Looc', 'Mactan', 'Maribago', 'Marigondon', 'Opon', 'Pajac', 'Pajo', 'Pangan-an', 'Punta Engaño', 'Pusok', 'Sabang', 'Santa Rosa', 'Subabasbas', 'Talima', 'Tingo', 'Tungasan', 'San Vicente');
      

      
      $notification = DB::select('SELECT * FROM notifs JOIN users ON users.id = notifs.notifUserId WHERE notifToUserId =' .auth()->user()->id.' ORDER BY notifCreatedAt DESC LIMIT 50');

      //return view('posts.show_distribution', compact('search', 'notification', 'postid', 'post', 'transparency', 'l', 'b1', 'b2'));
      return redirect()->back();
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

    public function transparency(Request $requests)
    {
      $l = "";
      $l = $requests->input('l');
      $request = $requests->get('menusettings');

      foreach ($request as $reques) {

          $post = new Transparency;
          $post -> transparencyUserId = auth()->user()->id;
          $post -> transparencyPostId = $reques['postid'];
          $post -> transparencyDate = $reques['date'];
          $post -> transparencyLocation = $reques['location'];
          $post -> transparencyHousehold = $reques['household'];
          $post -> transparencyAmount = $reques['hamount'];
          $post -> save();
      }
      
      return redirect()->back()->with('l', $l);
    }

    public function transparency2(Request $requests)
    {
      $l = "";
      $l = $requests->input('l');
      $id = "";
      $id = $requests->input('postid');
      $request = $requests->get('menusettings');

      foreach ($request as $reques) {

          $post = new Transparency;
          $post -> transparencyUserId = auth()->user()->id;
          $post -> transparencyPostId = $reques['postid'];
          $post -> transparencyDate = $reques['date'];
          $post -> transparencyLocation = $reques['location'];
          $post -> transparencyHousehold = $reques['household'];
          $post -> transparencyAmount = $reques['hamount'];
          $post -> save();
      }
      
      return redirect('/distribution/my?referenceno='.$id);
    }

    public function transparencyedit(Request $requests)
    {
      $l = "";
      $l = $requests->input('l');
      $request = $requests->get('menusettings');

      foreach ($request as $reques) {

          $post = Transparency::find($reques['transparencyid']);
          $post -> transparencyUserId = auth()->user()->id;
          $post -> transparencyPostId = $reques['postid'];
          $post -> transparencyLocation = $reques['location'];
          $post -> transparencyDate = $reques['date'];
          $post -> transparencyHousehold = $reques['household'];
          $post -> transparencyAmount = $reques['hamount'];
          $post -> save();
      }
      
      return redirect()->back()->with('l', $l);
    }

    public function transparencydelete(Request $request)
    {
      $l = "";
      $l = $request->input('l');
      $id = $request->input('transid');
      DB::table('transparencies')->where(['transparencyId'=> $id])->delete();
      return redirect()->back()->with('l', $l);
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

      return redirect()->back()->with('success', 'Post successfully updated.');
 
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
        // if($post->postCoverImage != 'noimage.jpg'){
        //   Storage::delete('public/cover_images/'.$post->postCoverImage);
        // }

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
          ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
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
      $posts2 = DB::select('SELECT * FROM posts JOIN users on posts.postUserId = users.id JOIN postimages ON posts.postId = postimages.postImagePostId ORDER BY posts.postUpdatedAt DESC LIMIT 10');
      
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


  public function distributionSidePanel(){
    return view('distribution.sidepanel');
  }

  public function distributionContent(Request $request){
    $search = "";
    $search = $request->input('search');
    $searchtitle = "";
    $searchtitle = $request->input('searchtitle');
    $searchname = "";
    $searchname = $request->input('searchname');
    $users = "";
    $post = "";

    $notification = DB::select('SELECT * FROM notifs JOIN users ON users.id = notifs.notifUserId WHERE notifToUserId =' .auth()->user()->id.' ORDER BY notifCreatedAt DESC LIMIT 50');

    if($searchtitle == ""){
      $vars = Post::query()
                    ->join('users', 'users.id', '=', 'posts.postUserId')
                    ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                    ->orderBy('postCreatedAt', 'DESC')
                    ->where('postUserId', '=', auth()->user()->id)
                    ->get();
    }else{
      $vars = Post::query()
                    ->join('users', 'users.id', '=', 'posts.postUserId')
                    ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                    ->orderBy('postCreatedAt', 'DESC')
                    ->where('postUserId', '=', auth()->user()->id)
                    ->where(function($query) use ($searchtitle){
                        $query->where('postCategory', 'LIKE', "%{$searchtitle}%")
                            ->orWhere('postCreatedAt', 'LIKE', "%{$searchtitle}%")
                            ->orWhere('postId', 'LIKE', "%{$searchtitle}%");
                            })
                    ->get();
    }

    $postid = $request->input('referenceno');
    
    $users = User::query()
            ->where(function($query) use ($searchname){
                $query->where('orgName', 'LIKE', "%{$searchname}%")
                ->orWhere('firstName', 'LIKE', "%{$searchname}%")
                ->orWhere('middleName', 'LIKE', "%{$searchname}%")
                ->orWhere('lastName', 'LIKE', "%{$searchname}%")
                ->orWhereRaw(
                    "concat(firstName, ' ', 'middleName', ' ', lastName) like '%" . $searchname . "%' ")
                ->orWhereRaw(
                        "concat(firstName, ' ', lastName) like '%" . $searchname . "%' ");
                })
          ->get();

    $trans = Transparency::query()
        ->join('users', 'users.id', '=', 'transparencies.transparencyUserId')
        ->join('postimages', 'transparencies.transparencyUserId', '=', 'postimages.postImagePostId')
        ->orderBy('transparencyCreatedAt', 'DESC')
        ->where('transparencyUserId', '=', auth()->user()->id)
        ->where('transparencyPostId', '=', $postid)
        ->get();

    $selecteduser = "";
    $userid = $request->input('userid');
    $selecteduser = User::query()
                    ->where('id', '=', $userid)
                    ->first();

      $post = Post::join('users', 'users.id', '=', 'posts.postUserId')
                    ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                    ->where('postId', $postid)
                    ->first();
      
      $transparency = Transparency::query()
                    ->join('users', 'users.id', '=', 'transparencies.transparencyHouseholdUserId')
                    ->join('posts', 'posts.postId', '=', 'transparencies.transparencyPostId')
                    ->orderBy('transparencyLocation', 'ASC')
                    ->where('transparencyPostId', '=', $postid)->get();

      $distribution = Distribution::join('users', 'users.id', '=', 'distributions.distributionAssignedTo')
                  ->orderBy('distributionLocation', 'ASC')
                  ->orderBy('distributionCreatedAt', 'DESC')
                  ->where('distributionPostId', '=', $postid)->get();

      $l = "";
      $l = $request->input('l');

      //mandaue
      $b1 = array('Alang-alang', 'Bakilid', 'Banilad', 'Basak', 'Cabancalan', 'Cambaro', 'Canduman', 'Casili', 'Casuntingan', 'Centro', 'Cubacub', 'Guizo', 'Ibabao-Estancia', 'Jagobiao', 'Labogon', 'Looc', 'Maguikay', 'Mantuyong', 'Opao', 'Pakna-an', 'Pagsabungan', 'Subangdaku', 'Tabok', 'Tawason', 'Tingub', 'Tipolo', 'Umapad');
      //lapu-lapu
      $b2 = array('Agus', 'Babag', 'Bankal', 'Baring', 'Basak', 'Buaya', 'Calawisan', 'Canjulao', 'Caw-oy', 'Cawhagan', 'Caubian', 'Gun-ob', 'Ibo', 'Looc', 'Mactan', 'Maribago', 'Marigondon', 'Opon', 'Pajac', 'Pajo', 'Pangan-an', 'Punta Engaño', 'Pusok', 'Sabang', 'Santa Rosa', 'Subabasbas', 'Talima', 'Tingo', 'Tungasan', 'San Vicente');


    return view('distribution.content', compact('search', 'searchtitle', 'searchname', 'notification', 'vars', 'users', 'trans', 'selecteduser', 'transparency', 'b1', 'b2', 'l', 'post', 'postid', 'userid', 'distribution'));
  }

  public function distributionSidePanel2(){
    return view('distribution.sidepanel_assign');
  }

  public function distributionContent2(Request $request){
    $search = "";
    $search = $request->input('search');
    $searchtitle = "";
    $searchtitle = $request->input('searchtitle');
    $searchname = "";
    $searchname = $request->input('searchname');
    $recepientid = "";
    $recepientid = $request->input('recepientid');
    $users = "";
    $post = "";

    $notification = DB::select('SELECT * FROM notifs JOIN users ON users.id = notifs.notifUserId WHERE notifToUserId =' .auth()->user()->id.' ORDER BY notifCreatedAt DESC LIMIT 50');

    if($searchtitle == ""){
      $vars = Post::query()
                    ->join('distributions', 'distributions.distributionPostId', '=', 'posts.postId')
                    ->join('users', 'users.id', '=', 'distributions.distributionUserId')
                    ->orderBy('postCreatedAt', 'DESC')
                    ->where('distributions.distributionAssignedTo', '=', auth()->user()->id)
                    ->get();
    }else{
      $vars = Post::query()
                    ->join('distributions', 'distributions.distributionPostId', '=', 'posts.postId')
                    ->join('users', 'users.id', '=', 'distributions.distributionUserId')
                    ->orderBy('postCreatedAt', 'DESC')
                    ->where('distributions.distributionAssignedTo', '=', auth()->user()->id)
                    ->where(function($query) use ($searchtitle){
                        $query->where('postCategory', 'LIKE', "%{$searchtitle}%")
                            ->orWhere('postCreatedAt', 'LIKE', "%{$searchtitle}%")
                            ->orWhere('postId', 'LIKE', "%{$searchtitle}%");
                            })
                    ->get();
    }

    $postid = $request->input('referenceno');
    
    $users = User::query()
            ->where(function($query) use ($searchname){
                $query->where('orgName', 'LIKE', "%{$searchname}%")
                ->orWhere('firstName', 'LIKE', "%{$searchname}%")
                ->orWhere('middleName', 'LIKE', "%{$searchname}%")
                ->orWhere('lastName', 'LIKE', "%{$searchname}%")
                ->orWhereRaw(
                    "concat(firstName, ' ', 'middleName', ' ', lastName) like '%" . $searchname . "%' ")
                ->orWhereRaw(
                        "concat(firstName, ' ', lastName) like '%" . $searchname . "%' ");
                })
          ->get();

    $trans = Transparency::query()
        ->join('users', 'users.id', '=', 'transparencies.transparencyUserId')
        ->join('postimages', 'transparencies.transparencyUserId', '=', 'postimages.postImagePostId')
        ->orderBy('transparencyCreatedAt', 'DESC')
        ->where('transparencyUserId', '=', auth()->user()->id)
        ->where('transparencyPostId', '=', $postid)
        ->get();

    $selecteduser = "";
    $userid = $request->input('userid');
    $selecteduser = User::query()
                    ->where('id', '=', $userid)
                    ->first();

      $post = Post::join('users', 'users.id', '=', 'posts.postUserId')
                    ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                    ->where('postId', $postid)
                    ->first();
      
      $transparency = Transparency::join('users', 'users.id', '=', 'transparencies.transparencyHouseholdUserId')->orderBy('transparencyLocation', 'ASC')->where('transparencyPostId', '=', $postid)->get();

      $distribution = Distribution::join('users', 'users.id', '=', 'distributions.distributionAssignedTo')
                  ->orderBy('distributionLocation', 'ASC')
                  ->orderBy('distributionCreatedAt', 'DESC')
                  ->where('distributionPostId', '=', $postid)
                  ->where('distributionAssignedTo', '=', auth()->user()->id)
                  ->get();

      $l = "";
      $l = $request->input('l');

      $allusers = User::query()->orderBy('lastname', 'ASC')->get();

      //mandaue
      $b1 = array('Alang-alang', 'Bakilid', 'Banilad', 'Basak', 'Cabancalan', 'Cambaro', 'Canduman', 'Casili', 'Casuntingan', 'Centro', 'Cubacub', 'Guizo', 'Ibabao-Estancia', 'Jagobiao', 'Labogon', 'Looc', 'Maguikay', 'Mantuyong', 'Opao', 'Pakna-an', 'Pagsabungan', 'Subangdaku', 'Tabok', 'Tawason', 'Tingub', 'Tipolo', 'Umapad');
      //lapu-lapu
      $b2 = array('Agus', 'Babag', 'Bankal', 'Baring', 'Basak', 'Buaya', 'Calawisan', 'Canjulao', 'Caw-oy', 'Cawhagan', 'Caubian', 'Gun-ob', 'Ibo', 'Looc', 'Mactan', 'Maribago', 'Marigondon', 'Opon', 'Pajac', 'Pajo', 'Pangan-an', 'Punta Engaño', 'Pusok', 'Sabang', 'Santa Rosa', 'Subabasbas', 'Talima', 'Tingo', 'Tungasan', 'San Vicente');


    return view('distribution.content_assign', compact('search', 'recepientid', 'allusers', 'searchtitle', 'searchname', 'notification', 'vars', 'users', 'trans', 'selecteduser', 'transparency', 'b1', 'b2', 'l', 'post', 'postid', 'userid', 'distribution'));
  }

  public function distributiondelete(Request $request)
  {

    $id = $request->input('distid');
    DB::table('distributions')->where(['distributionId'=> $id])->delete();
    return redirect()->back()->with('success', 'Record removed.');

  }


}
