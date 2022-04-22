<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\PostReactions;
use App\Models\Comment;
use DB;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function index(){
      $title = "Welcome to Index..";
      return view('pages.index', compact('title'));
    }

    public function about(){
      $about = "Welcome to About..";
      return view('pages.about')->with('about', $about);
    }

    public function services(){
      $data = array(
        'title' => 'Services',
        'services' => ['Web Design', 'Programming', 'SEO']
      );
      return view('pages.services')->with($data);
    }

    public function login(){
      return view('auth.login');
    }

    public function home2(){
      return view('pages.home');
    }

    public function preFilterByLocation(Request $request){
      $search = "";
      $search = $request->input('search');
      $notification = DB::select('SELECT * FROM notifs JOIN users ON users.id = notifs.notifUserId WHERE notifToUserId =' .auth()->user()->id.' ORDER BY notifCreatedAt DESC');

          $category = "All";
          $region = "";
          $province = "";
          $city = "";
          $barangay = "";
          $sector = ""; 

          $posts = DB::select('SELECT * FROM posts JOIN users ON users.id = posts.postUserId JOIN postimages ON posts.postId = postimages.postImagePostId ORDER BY postUpdatedAt DESC');
          $comment = DB::select('SELECT * FROM comments');
          $likes2 = DB::select('SELECT * FROM likes');
          $shares = DB::select('SELECT * FROM shares');
          $follows = DB::select('SELECT * FROM follows');

          return view('pages.filterbylocation', compact('notification','posts', 'comment', 'likes2', 'shares', 'follows', 'category', 'region', 'province', 'city', 'barangay', 'sector', 'search'));
    }

    public function filterByLocation(Request $request){
      $search = "";
      $search = $request->input('search');
      $notification = DB::select('SELECT * FROM notifs JOIN users ON users.id = notifs.notifUserId WHERE notifToUserId =' .auth()->user()->id.' ORDER BY notifCreatedAt DESC');

      $view = $request->input('view');
      $category = $request->get('category');
      $region = $request->get('region');
      $province = $request->get('province');
      $city = $request->get('city');
      $barangay = "";
      $barangay = $request->input('barangay');
      //$barangay2 = $request->get('barangay2');
      $sector = $request->input('sector');
      

      // if($barangay1 == ""){
      //   $barangay = $barangay2;
      // }else{
      //   $barangay = $barangay1;
      // }

      if($city == ""){$barangay = "";}

      if($category == "All"){
            
                      // $posts = DB::select('SELECT * FROM posts JOIN users ON users.id = posts.postUserId');
                      // $comment = DB::select('SELECT * FROM comments');
                      // $likes2 = DB::select('SELECT * FROM likes');
                      // $shares = DB::select('SELECT * FROM shares');
                      // $follows = DB::select('SELECT * FROM follows');
            
                      if($region == ""){
                        //REGION
              
                        if($province == ""){
                          //PROVINCE
              
                          if($city == ""){
                            //CITY
              
                            if($barangay== "") {
                              //BARANGAY
              
                              if($sector== "") {
                                //SECTOR
                                  $posts = Post::query()
                                  ->join('users', 'users.id', '=', 'posts.postUserId')
                                  ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                  ->orderBy('postUpdatedAt', 'DESC')
                                  ->get();
              
                                  $comment = DB::select('SELECT * FROM comments');
                                  $likes2 = DB::select('SELECT * FROM likes');
                                  $shares = DB::select('SELECT * FROM shares');
                                  $follows = DB::select('SELECT * FROM follows');
                              }else{
                                //ELSE SECTOR
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postSector', '=', $sector)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }
              
                            }else{
                              //ELSE BARANGAY
              
                              if($sector== "") {
                                //SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postBarangay', '=', $barangay)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }else{
                                //ELSE SECTOR
                                
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postBarangay', '=', $barangay)
                                ->where('postSector', '=', $sector)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }
                            }
              
                          }else{
                            //ELSE CITY
              
                            if($barangay== "") {
                              //BARANGAY
              
                              if($sector== "") {
                                //SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postCity', '=', $city)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }else{
                                //ELSE SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postCity', '=', $city)
                                ->where('postSector', '=', $sector)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }
              
                            }else{
                              //ELSE BARANGAY
              
                              if($sector== "") {
                                //SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postCity', '=', $city)
                                ->where('postBarangay', '=', $barangay)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }else{
                                //ELSE SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postCity', '=', $city)
                                ->where('postBarangay', '=', $barangay)
                                ->where('postSector', '=', $sector)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }
                            }
                          }
              
                        }else{
                          //ELSE PROVINCE
              
                          if($city == ""){
                            //CITY
              
                            if($barangay== "") {
                              //BARANGAY
              
                              if($sector== "") {
                                //SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postProvince', '=', $province)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }else{
                                //ELSE SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postProvince', '=', $province)
                                ->where('postSector', '=', $sector)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }
              
                            }else{
                              //ELSE BARANGAY
              
                              if($sector== "") {
                                //SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postProvince', '=', $province)
                                ->where('postBarangay', '=', $barangay)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }else{
                                //ELSE SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postProvince', '=', $province)
                                ->where('postBarangay', '=', $barangay)
                                ->where('postSector', '=', $sector)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }
                            }
              
                          }else{
                            //ELSE CITY
              
                            if($barangay== "") {
                              //BARANGAY
              
                              if($sector== "") {
                                //SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postProvince', '=', $province)
                                ->where('postCity', '=', $city)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }else{
                                //ELSE SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postProvince', '=', $province)
                                ->where('postCity', '=', $city)
                                ->where('postSector', '=', $sector)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }
              
                            }else{
                              //ELSE BARANGAY
              
                              if($sector== "") {
                                //SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postProvince', '=', $province)
                                ->where('postCity', '=', $city)
                                ->where('postBarangay', '=', $barangay)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }else{
                                //ELSE SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postProvince', '=', $province)
                                ->where('postCity', '=', $city)
                                ->where('postBarangay', '=', $barangay)
                                ->where('postSector', '=', $sector)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }
                            }
                          }
                        }
              
                      }else{
                      //ELSE REGION
              
                        if($province == ""){
                          //PROVINCE
              
                          if($city == ""){
                            //CITY
              
                            if($barangay== "") {
                              //BARANGAY
              
                              if($sector== "") {
                                //SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postRegion', '=', $region)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }else{
                                //ELSE SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postRegion', '=', $region)
                                ->where('postSector', '=', $sector)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }
              
                            }else{
                              //ELSE BARANGAY
              
                              if($sector== "") {
                                //SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postRegion', '=', $region)
                                ->where('postBarangay', '=', $barangay)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }else{
                                //ELSE SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postRegion', '=', $region)
                                ->where('postBarangay', '=', $barangay)
                                ->where('postSector', '=', $sector)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }
                            }
              
                          }else{
                            //ELSE CITY
              
                            if($barangay== "") {
                              //BARANGAY
              
                              if($sector== "") {
                                //SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postRegion', '=', $region)
                                ->where('postCity', '=', $city)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }else{
                                //ELSE SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postRegion', '=', $region)
                                ->where('postCity', '=', $city)
                                ->where('postSector', '=', $sector)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }
              
                            }else{
                              //ELSE BARANGAY
              
                              if($sector== "") {
                                //SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postRegion', '=', $region)
                                ->where('postCity', '=', $city)
                                ->where('postBarangay', '=', $barangay)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }else{
                                //ELSE SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postRegion', '=', $region)
                                ->where('postBarangay', '=', $barangay)
                                ->where('postCity', '=', $city)
                                ->where('postSector', '=', $sector)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }
                            }
                          }
              
                        }else{
                          //ELSE PROVINCE
              
                          if($city == ""){
                            //CITY
              
                            if($barangay== "") {
                              //BARANGAY
              
                              if($sector== "") {
                                //SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postRegion', '=', $region)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }else{
                                //ELSE SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postRegion', '=', $region)
                                ->where('postSector', '=', $sector)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }
              
                            }else{
                              //ELSE BARANGAY
              
                              if($sector== "") {
                                //SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postRegion', '=', $region)
                                ->where('postBarangay', '=', $barangay)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }else{
                                //ELSE SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postRegion', '=', $region)
                                ->where('postBarangay', '=', $barangay)
                                ->where('postSector', '=', $sector)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }
                            }
              
                          }else{
                            //ELSE CITY
              
                            if($barangay== "") {
                              //BARANGAY
              
                              if($sector== "") {
                                //SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postRegion', '=', $region)
                                ->where('postCity', '=', $city)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }else{
                                //ELSE SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postRegion', '=', $region)
                                ->where('postCity', '=', $city)
                                ->where('postSector', '=', $sector)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }
              
                            }else{
                              //ELSE BARANGAY
              
                              if($sector== "") {
                                //SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postRegion', '=', $region)
                                ->where('postCity', '=', $city)
                                ->where('postBarangay', '=', $barangay)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }else{
                                //ELSE SECTOR
              
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postRegion', '=', $region)
                                ->where('postCity', '=', $city)
                                ->where('postBarangay', '=', $barangay)
                                ->where('postSector', '=', $sector)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
              
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                              }
                            }
                          }
                        }
                      }//END REGION
            
      }else{
            
                    if($region == ""){
                      //REGION
            
                      if($province == ""){
                        //PROVINCE
            
                        if($city == ""){
                          //CITY
            
                          if($barangay== "") {
                            //BARANGAY
            
                            if($sector== "") {
                              //SECTOR
                                $posts = Post::query()
                                ->join('users', 'users.id', '=', 'posts.postUserId')
                                ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                                ->where('postCategory', '=', $category)
                                ->orderBy('postUpdatedAt', 'DESC')
                                ->get();
            
                                $comment = DB::select('SELECT * FROM comments');
                                $likes2 = DB::select('SELECT * FROM likes');
                                $shares = DB::select('SELECT * FROM shares');
                                $follows = DB::select('SELECT * FROM follows');
                            }else{
                              //ELSE SECTOR
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postSector', '=', $sector)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }
            
                          }else{
                            //ELSE BARANGAY
            
                            if($sector== "") {
                              //SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postBarangay', '=', $barangay)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }else{
                              //ELSE SECTOR
                              
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postBarangay', '=', $barangay)
                              ->where('postSector', '=', $sector)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }
                          }
            
                        }else{
                          //ELSE CITY
            
                          if($barangay== "") {
                            //BARANGAY
            
                            if($sector== "") {
                              //SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postCity', '=', $city)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }else{
                              //ELSE SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postCity', '=', $city)
                              ->where('postSector', '=', $sector)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }
            
                          }else{
                            //ELSE BARANGAY
            
                            if($sector== "") {
                              //SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postCity', '=', $city)
                              ->where('postBarangay', '=', $barangay)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }else{
                              //ELSE SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postCity', '=', $city)
                              ->where('postBarangay', '=', $barangay)
                              ->where('postSector', '=', $sector)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }
                          }
                        }
            
                      }else{
                        //ELSE PROVINCE
            
                        if($city == ""){
                          //CITY
            
                          if($barangay== "") {
                            //BARANGAY
            
                            if($sector== "") {
                              //SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postProvince', '=', $province)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }else{
                              //ELSE SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postProvince', '=', $province)
                              ->where('postSector', '=', $sector)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }
            
                          }else{
                            //ELSE BARANGAY
            
                            if($sector== "") {
                              //SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postProvince', '=', $province)
                              ->where('postBarangay', '=', $barangay)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }else{
                              //ELSE SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postProvince', '=', $province)
                              ->where('postBarangay', '=', $barangay)
                              ->where('postSector', '=', $sector)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }
                          }
            
                        }else{
                          //ELSE CITY
            
                          if($barangay== "") {
                            //BARANGAY
            
                            if($sector== "") {
                              //SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postProvince', '=', $province)
                              ->where('postCity', '=', $city)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }else{
                              //ELSE SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postProvince', '=', $province)
                              ->where('postCity', '=', $city)
                              ->where('postSector', '=', $sector)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }
            
                          }else{
                            //ELSE BARANGAY
            
                            if($sector== "") {
                              //SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postProvince', '=', $province)
                              ->where('postCity', '=', $city)
                              ->where('postBarangay', '=', $barangay)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }else{
                              //ELSE SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postProvince', '=', $province)
                              ->where('postCity', '=', $city)
                              ->where('postBarangay', '=', $barangay)
                              ->where('postSector', '=', $sector)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }
                          }
                        }
                      }
            
                    }else{
                    //ELSE REGION
            
                      if($province == ""){
                        //PROVINCE
            
                        if($city == ""){
                          //CITY
            
                          if($barangay== "") {
                            //BARANGAY
            
                            if($sector== "") {
                              //SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postRegion', '=', $region)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }else{
                              //ELSE SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postRegion', '=', $region)
                              ->where('postSector', '=', $sector)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }
            
                          }else{
                            //ELSE BARANGAY
            
                            if($sector== "") {
                              //SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postRegion', '=', $region)
                              ->where('postBarangay', '=', $barangay)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }else{
                              //ELSE SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postRegion', '=', $region)
                              ->where('postBarangay', '=', $barangay)
                              ->where('postSector', '=', $sector)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }
                          }
            
                        }else{
                          //ELSE CITY
            
                          if($barangay== "") {
                            //BARANGAY
            
                            if($sector== "") {
                              //SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postRegion', '=', $region)
                              ->where('postCity', '=', $city)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }else{
                              //ELSE SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postRegion', '=', $region)
                              ->where('postCity', '=', $city)
                              ->where('postSector', '=', $sector)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }
            
                          }else{
                            //ELSE BARANGAY
            
                            if($sector== "") {
                              //SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postRegion', '=', $region)
                              ->where('postCity', '=', $city)
                              ->where('postBarangay', '=', $barangay)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }else{
                              //ELSE SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postRegion', '=', $region)
                              ->where('postBarangay', '=', $barangay)
                              ->where('postCity', '=', $city)
                              ->where('postSector', '=', $sector)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }
                          }
                        }
            
                      }else{
                        //ELSE PROVINCE
            
                        if($city == ""){
                          //CITY
            
                          if($barangay== "") {
                            //BARANGAY
            
                            if($sector== "") {
                              //SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postRegion', '=', $region)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }else{
                              //ELSE SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postRegion', '=', $region)
                              ->where('postSector', '=', $sector)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }
            
                          }else{
                            //ELSE BARANGAY
            
                            if($sector== "") {
                              //SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postRegion', '=', $region)
                              ->where('postBarangay', '=', $barangay)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }else{
                              //ELSE SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postRegion', '=', $region)
                              ->where('postBarangay', '=', $barangay)
                              ->where('postSector', '=', $sector)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }
                          }
            
                        }else{
                          //ELSE CITY
            
                          if($barangay== "") {
                            //BARANGAY
            
                            if($sector== "") {
                              //SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postRegion', '=', $region)
                              ->where('postCity', '=', $city)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }else{
                              //ELSE SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postRegion', '=', $region)
                              ->where('postCity', '=', $city)
                              ->where('postSector', '=', $sector)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }
            
                          }else{
                            //ELSE BARANGAY
            
                            if($sector== "") {
                              //SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postRegion', '=', $region)
                              ->where('postCity', '=', $city)
                              ->where('postBarangay', '=', $barangay)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }else{
                              //ELSE SECTOR
            
                              $posts = Post::query()
                              ->join('users', 'users.id', '=', 'posts.postUserId')
                              ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                              ->where('postCategory', '=', $category)
                              ->where('postRegion', '=', $region)
                              ->where('postCity', '=', $city)
                              ->where('postBarangay', '=', $barangay)
                              ->where('postSector', '=', $sector)
                              ->orderBy('postUpdatedAt', 'DESC')
                              ->get();
            
                              $comment = DB::select('SELECT * FROM comments');
                              $likes2 = DB::select('SELECT * FROM likes');
                              $shares = DB::select('SELECT * FROM shares');
                              $follows = DB::select('SELECT * FROM follows');
                            }
                          }
                        }
                      }
                    }//END REGION
            
            
            
      } //END CATEGORY
      

      return view('pages.filterbylocation', compact('search','notification','posts', 'comment', 'likes2', 'shares', 'follows', 'category', 'region', 'province', 'city', 'barangay', 'sector'));
      
    }

    public function activitiesDonated(Request $request){

      $search = "";
      $search = $request->input('search');
                
      $tran = DB::table('transactions')
                ->join('posts', 'posts.postId', '=', 'transactions.transactionPostId')
                ->join('users', 'users.id', '=', 'posts.postUserId')
                ->where('transactions.transactionUserId', '=', auth()->user()->id)
                ->orderBy('transactionCreatedAt', 'DESC')
                ->get();

      $notification = DB::select('SELECT * FROM notifs JOIN users ON users.id = notifs.notifUserId WHERE notifToUserId =' .auth()->user()->id.' ORDER BY notifCreatedAt DESC');
      $user = DB::select('SELECT * FROM users WHERE id = '.auth()->user()->id);

      return view('pages.activitiesdonated', compact('tran', 'search', 'user', 'notification'));

    }

    public function activitiesReceived(Request $request){

      $search = "";
      $search = $request->input('search');

      $notification = DB::select('SELECT * FROM notifs JOIN users ON users.id = notifs.notifUserId WHERE notifToUserId =' .auth()->user()->id.' ORDER BY notifCreatedAt DESC');

      $tran = DB::table('transactions')
      ->join('users', 'users.id', '=', 'transactions.transactionUserId')
      ->join('posts', 'posts.postId', '=', 'transactions.transactionPostId')
      ->where('posts.postUserId', '=', auth()->user()->id)
      ->orderBy('transactionCreatedAt', 'DESC')
      ->get();
      $user = DB::select('SELECT * FROM users WHERE id = '.auth()->user()->id);

      return view('pages.activitiesreceived', compact('tran', 'search', 'user', 'notification'));

    }

    public function leaderboardBarangay(Request $request){

      $search = "";
      $search = $request->input('search');

      $notification = DB::select('SELECT * FROM notifs JOIN users ON users.id = notifs.notifUserId WHERE notifToUserId =' .auth()->user()->id.' ORDER BY notifCreatedAt DESC');

      if($request->get('selectbarangay') != ""){
        $selectbarangay = $request->get('selectbarangay');
      }else{
        $selectbarangay = auth()->user()->barangay;
      }

      if($request->get('selectcity') != ""){
        $selectcity = $request->get('selectcity');
      }else{
        $selectcity = auth()->user()->city;
      }

      if($request->get('selectprovince') != ""){
        $selectprovince = $request->get('selectprovince');
      }else{
        $selectprovince = auth()->user()->province;
      }
      //mandaue
      $b1 = array('Alang-alang', 'Bakilid', 'Banilad', 'Basak', 'Cabancalan', 'Cambaro', 'Canduman', 'Casili', 'Casuntingan', 'Centro', 'Cubacub', 'Guizo', 'Ibabao-Estancia', 'Jagobiao', 'Labogon', 'Looc', 'Maguikay', 'Mantuyong', 'Opao', 'Pakna-an', 'Pagsabungan', 'Subangdaku', 'Tabok', 'Tawason', 'Tingub', 'Tipolo', 'Umapad');
      //lapu-lapu
      $b2 = array('Agus', 'Babag', 'Bankal', 'Baring', 'Basak', 'Buaya', 'Calawisan', 'Canjulao', 'Caw-oy', 'Cawhagan', 'Caubian', 'Gun-ob', 'Ibo', 'Looc', 'Mactan', 'Maribago', 'Marigondon', 'Opon', 'Pajac', 'Pajo', 'Pangan-an', 'Punta Engaño', 'Pusok', 'Sabang', 'Santa Rosa', 'Subabasbas', 'Talima', 'Tingo', 'Tungasan', 'San Vicente');
      $city = "";
      $array = array('1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th', '11th', '12th', '13th', '14th', '15th', '16th', '17th', '18th', '19th', '20th');

      if($selectcity == "All"){
        $selectbarangay = "All";
      }
      
      if($selectcity == "All" && $selectbarangay == "All"){
        $vars = DB::select('SELECT * FROM users WHERE role != "ADMIN" AND amountGiven != 0 AND province = "'.$selectprovince.'" ORDER BY amountGiven DESC LIMIT 20');
      }else if($selectcity != "All" && $selectbarangay == "All"){
        $vars = DB::select('SELECT * FROM users WHERE role != "ADMIN" AND amountGiven != 0 AND city = "'.$selectcity.'" AND province = "'.$selectprovince.'" ORDER BY amountGiven DESC LIMIT 20');
      }else if($selectcity != "All" && $selectbarangay != "All"){
        $vars = DB::select('SELECT * FROM users WHERE role != "ADMIN" AND amountGiven != 0 AND barangay = "'.$selectbarangay.'" AND city = "'.$selectcity.'" AND province = "'.$selectprovince.'" ORDER BY amountGiven DESC LIMIT 20');
      }
      
      foreach($b1 as $b){
        if($b == auth()->user()->barangay){
          $city = "Mandaue";
        }
      }

      foreach($b2 as $b){
        if($b == auth()->user()->barangay){
          $city = "Lapu-lapu";
        }
      }

      return view('pages.leaderboards', compact('notification','vars', 'array', 'city', 'b1', 'b2', 'selectbarangay', 'selectcity', 'selectprovince', 'search'));
    }

    public function leaderboardCity(){

      $array = array('1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th', '11th', '12th', '13th', '14th', '15th', '16th', '17th', '18th', '19th', '20th');
      $vars = DB::select('SELECT * FROM users WHERE role != "ADMIN" AND amountGiven != 0 ORDER BY amountGiven DESC LIMIT 20');
      $vars2 = DB::select('SELECT * FROM users WHERE role != "ADMIN" ORDER BY amountGiven DESC');
      return view('pages.leaderboard_city', compact('vars', 'vars2', 'array'));
    }

    public function leaderboardProvince(){

      $array = array('1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th', '11th', '12th', '13th', '14th', '15th', '16th', '17th', '18th', '19th', '20th');
      $vars = DB::select('SELECT * FROM users WHERE role != "ADMIN" AND amountGiven != 0 ORDER BY amountGiven DESC LIMIT 20');
      $vars2 = DB::select('SELECT * FROM users WHERE role != "ADMIN" ORDER BY amountGiven DESC');
      return view('pages.leaderboard_province', compact('vars', 'vars2', 'array'));
    }
}
 