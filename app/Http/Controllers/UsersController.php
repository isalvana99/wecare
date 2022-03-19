<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Post;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;
use PDF;
use View;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('role:USER');
        //$this->middleware('role:ORG');
    }

    public function index()
    {
        // $posts = User::all();
        // return view('users.userprofile')->with('posts', $posts);
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
        //
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $posts = User::find($id);
        // return view('users.my_profile')->with('posts', $posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //For the profile settings controller
    public function edit($id)
    {
        $notification = DB::select('SELECT * FROM notifs JOIN users ON users.id = notifs.notifUserId WHERE notifToUserId =' .auth()->user()->id.' ORDER BY notifCreatedAt DESC LIMIT 50');
        $posts = User::find($id);
        if($posts->orgName == "")
        {
            return view('users.my_user_settings', compact('posts', 'notification'));
            //return view('organization.my_org_settings')->with('posts', $posts);
        }else
        {
            //return view('users.my_user_settings')->with('posts', $posts);
            return view('organization.my_org_settings', compact('posts', 'notification'));
        }
        //return view('users.my_profile_edit')->with('posts', $posts);
    }

    //For the change password redirection/view only
    public function viewChangePassword($id)
    {
        $notification = DB::select('SELECT * FROM notifs JOIN users ON users.id = notifs.notifUserId WHERE notifToUserId =' .auth()->user()->id.' ORDER BY notifCreatedAt DESC LIMIT 50');
        $posts = User::find($id);
        return view('users.password_change', compact('posts', 'notification'));
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
        $posts = User::find($id);
        $this -> validate($request,[
            'firstname' => ['string', 'max:255', 'nullable'],
            'lastname' => ['string', 'max:255', 'nullable'],
            'middlename' => ['string', 'max:255', 'nullable'],
            'day' => ['string', 'max:255', 'nullable'],
            'month' => ['string', 'max:255', 'nullable'],
            'year' => ['string', 'max:255', 'nullable'],
            'age' => ['string', 'max:255', 'nullable'],
            'sex' => ['string', 'max:255', 'nullable'],
            'sector' => ['nullable', 'string', 'max:255'],
            'barangay' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'min:8'],
            'license' => ['nullable', 'string', 'min:8'],
            'org_name' => ['string', 'max:255', 'nullable'],
            'license' => ['string', 'max:255', 'nullable'],
            'profile_image' => 'image|nullable|max:1999',
          ]);
    
          //handles the file upload
          if($request->hasFile('profile_image')){
            //get filename with extension
            $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            //filename to Store
            $fileNameToStore = $filename .'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('profile_image')->storeAs('public/profile_images', $fileNameToStore );
          }
    
          $post = User::find($id);
          $post ->  firstName = $request->input('firstname');
          $post ->  lastName = $request->input('lastname');
          $post ->  middleName = $request->input('middlename');
          $post ->  birthday = $request->input('year').$request->input('month').$request->input('day');
          $post ->  sex = $request->input('sex');
          $post ->  phoneNumber = $request->input('phone_number');
          $post ->  province = $request->input('province');
          $post ->  region = $request->input('region');
          $post ->  city = $request->input('city');
          $post ->  barangay = $request->input('barangay');
          $post ->  sector = $request->input('sector');
          $post ->  orgName = $request->input('org_name');
          $post ->  license = $request->input('license');
          if($request->hasFile('profile_image')){
            $post->profileImage = $fileNameToStore;
          }
          $post->save();
    
          return redirect('users/'.$id.'/edit')->with('posts', $posts)->with('success','Wonderful! Changes saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function myprofilepic($id)
    {
        $user_pic = User::find($id);
        return view('users.home')->with('user_pic', $user_pic);
    }

    public function home(){
        return view('users.home');
    }

    public function usertopnav(){
        return view('users.userTopNav');
    }

    public function viewTimeline(Request $request, $id){

        $user = User::find($id);
        $search = "";
        $search = $request->input('search');

        $posts = Post::query()
                ->join('users', 'users.id', '=', 'posts.postUserId')
                ->where('posts.postUserId', $id)
                ->orderBy('posts.postUpdatedAt', 'DESC')
                ->get();
        
        $comment = DB::select('SELECT * FROM comments');
        $likes2 = DB::select('SELECT * FROM likes');
        $shares = DB::select('SELECT * FROM shares');
        $follows = DB::select('SELECT * FROM follows JOIN users ON users.id = follows.followUserId ORDER BY follows.followCreatedAt DESC LIMIT 15');
        $badge = DB::select('SELECT * FROM badges JOIN users ON users.id = badgeUserId WHERE badgeUserId = ' .auth()->user()->id);

        $vars = DB::select('SELECT * FROM inquiries JOIN users on users.id = inquiryUserId WHERE inquiryMessage != "" ORDER BY inquiryCreatedAt ASC');
        $notification = DB::select('SELECT * FROM notifs JOIN users ON users.id = notifs.notifUserId WHERE notifToUserId =' .auth()->user()->id.' ORDER BY notifCreatedAt DESC');
        return view('users.timeline', compact('notification','posts', 'user', 'comment', 'likes2', 'shares', 'follows', 'badge', 'search', 'vars'));
    }

    public function general_settings(){
        return view('users.my_settings');
    }

    public function typepassword(){
        return view('users.password_verification');
    }

    public function password_verification(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            // Current password and new password same
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password successfully changed!");
        
    }

    public function request_verification(Request $request){
        
        $this -> validate($request,[
            'user_id' => 'image|required|max:1999',
          ]);

        //handles the file upload
        if($request->hasFile('user_id')){
            //get filename with extension
            $filenameWithExt = $request->file('user_id')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('user_id')->getClientOriginalExtension();
            //filename to Store
            $fileNameToStore = $filename .'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('user_id')->storeAs('public/request_verification', $fileNameToStore );
        }

        $user = new Review;
        $user -> reviewUserId = auth()->user()->id;
        if($request->hasFile('user_id')){
            $user->reviewImage = $fileNameToStore;
        }
        $user -> reviewType = "VERIFICATION";
        $user -> reviewStatus = "PROCESS";
        $user -> save();

        return redirect()->back();
    }

    public function request_deletion(){

        $user = new Review;
        $user -> reviewUserId = auth()->user()->id;
        $user -> reviewType = "DELETION";
        $user -> reviewStatus = "PROCESS";
        $user -> save();

        return redirect()->back();
    }
    
}

