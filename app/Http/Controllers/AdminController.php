<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Post;
use App\Models\Report;
use App\Models\Comment;
use App\Models\AdminLog;
use App\Models\Review;
use App\Models\Notif;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;
use PDF;
use View;

class AdminController extends Controller
{
    public function adminhome(Request $request)
    {
        $tiles = array('Dashboard', 'People', 'Organization', 'Posts', 'Users Inquiries', 'Users Leaderboards', 'Donation Monitoring', 'Requests', 'Reports', 'Logs', 'Settings');
        $selected_tile = $request->input('selected_tile');
        $count = 1;
        date_default_timezone_set("Asia/Manila"); $month = date("Y-m");
        $data_donated = [];
        $data_received = [];

        $people = DB::select('SELECT * FROM users WHERE orgName IS NULL AND role = "USER"');
        $people2 = DB::select('SELECT * FROM users WHERE role != "ADMIN" ORDER BY accountUpdatedAt DESC LIMIT 50');
        $org = DB::select('SELECT * FROM users WHERE orgName IS NOT NULL AND role = "USER"');
        $post = DB::select('SELECT * FROM posts JOIN users ON users.id = posts.postUserId');
        $transactions = DB::select('SELECT * FROM transactions JOIN users ON users.id = transactions.transactionUserId ORDER BY transactionCreatedAt DESC LIMIT 30');
        
        $jan1=0; $feb1=0; $mar1=0;$apr1=0;$may1=0;$jun1=0;$jul1=0;$aug1=0;$sept1=0;$oct1=0;$nov1=0;$dec1=0;
        $jan2=0; $feb2=0; $mar2=0;$apr2=0;$may2=0;$jun2=0;$jul2=0;$aug2=0;$sept2=0;$oct2=0;$nov2=0;$dec2=0;
        $djan=0; $dfeb=0; $dmar=0;$dapr=0;$dmay=0;$djun=0;$djul=0;$daug=0;$dsept=0;$doct=0;$dnov=0;$ddec=0;
        $rjan=0; $rfeb=0; $rmar=0;$rapr=0;$rmay=0;$rjun=0;$rjul=0;$raug=0;$rsept=0;$roct=0;$rnov=0;$rdec=0;

        for($i=0; $i<count($people); $i++){
            if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-01"){
                $jan1 += $people[$i]->amountGiven;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-02"){
                $feb1 += $people[$i]->amountGiven;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-03"){
                $mar1 += $people[$i]->amountGiven;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-04"){
                $apr1 += $people[$i]->amountGiven;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-05"){
                $may1 += $people[$i]->amountGiven;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-06"){
                $jun1 += $people[$i]->amountGiven;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-07"){
                $jul1 += $people[$i]->amountGiven;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-08"){
                $aug1 += $people[$i]->amountGiven;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-09"){
                $sept1 += $people[$i]->amountGiven;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-10"){
                $oct1 += $people[$i]->amountGiven;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-11"){
                $nov1 += $people[$i]->amountGiven;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-12"){
                $dec1 += $people[$i]->amountGiven;
            }
        }

        for($i=0; $i<count($people); $i++){
            if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-01"){
                $jan2 += $people[$i]->amountReceived;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-02"){
                $feb2 += $people[$i]->amountReceived;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-03"){
                $mar2 += $people[$i]->amountReceived;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-04"){
                $apr2 += $people[$i]->amountReceived;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-05"){
                $may2 += $people[$i]->amountReceived;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-06"){
                $jun2 += $people[$i]->amountReceived;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-07"){
                $jul2 += $people[$i]->amountReceived;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-08"){
                $aug2 += $people[$i]->amountReceived;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-09"){
                $sept2 += $people[$i]->amountReceived;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-10"){
                $oct2 += $people[$i]->amountReceived;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-11"){
                $nov2 += $people[$i]->amountReceived;
            }else if(date("Y-m", strtotime($people[$i]->accountCreatedAt)) == "2022-12"){
                $dec2 += $people[$i]->amountReceived;
            }
        }

        $max = 0; $total_donated = 0; $total_received = 0;
        $data_donated1 = [$jan1, $feb1, $mar1,$apr1,$may1,$jun1,$jul1,$aug1,$sept1,$oct1,$nov1,$dec1];
        $data_received2 = [$jan2, $feb2, $mar2,$apr2,$may2,$jun2,$jul2,$aug2,$sept2,$oct2,$nov2,$dec2];
        // for($i=0; $i<count($data_donated1); $i++){
        //     if($data_donated1[$i] < $data_donated1[$i]){
        //         $max = $data_donated1[$i];
        //     }
        // }

        foreach ($data_donated1 as $key => $value) {
            if ($value >= $max) 
             $max = number_format((float)$value, 2, '.', '');     
        }

        foreach ($data_donated1 as $key => $value) {
            
             $data_donated[$key] = (number_format((float)$value, 2, '.', '') / $max) * 100;     
        }

        foreach ($data_donated1 as $key => $value) {
            
            $total_donated += number_format((float)$data_donated1[$key], 2, '.', '');     
        }

        foreach ($data_received2 as $key => $value) {
            
            $total_received += number_format((float)$data_received2[$key], 2, '.', '');    
        }

        $data_donated = [$jan1, $feb1, $mar1,$apr1,$may1,$jun1,$jul1,$aug1,$sept1,$oct1,$nov1,$dec1];
        $data_received = [$jan2, $feb2, $mar2,$apr2,$may2,$jun2,$jul2,$aug2,$sept2,$oct2,$nov2,$dec2];
        //$data_donated = [$jan2, $feb2, $mar2,$apr2,$may2,$jun2,$jul2,$aug2,$sept2,$oct2,$nov2,$dec2];
        
        $layoutpeople = DB::select('SELECT * FROM users WHERE orgName IS NULL AND role = "USER"');
        $layoutorg = DB::select('SELECT * FROM users WHERE orgName IS NOT NULL AND role = "USER"');
        $layoutpost = DB::select('SELECT * FROM posts');
        $layoutinquiry = DB::select('SELECT * FROM inquiries');
        $layoutreport = DB::select('SELECT * FROM reports');
        $layoutrequest = DB::select('SELECT * FROM reviews');
        
        return view('admin.adminhome', compact('people', 'org', 'post', 'count', 'selected_tile', 'tiles', 'data_donated', 'data_received', 'max','total_donated', 'total_received', 'people2', 'transactions', 'layoutpeople', 'layoutorg', 'layoutpost', 'layoutinquiry', 'layoutreport', 'layoutrequest'));
    }

    public function adminUsersTable(Request $request)
    {
        $tiles = array('Dashboard', 'People', 'Organization', 'Posts', 'Users Inquiries', 'Users Leaderboards', 'Donation Monitoring', 'Requests', 'Reports', 'Logs', 'Settings');
        $selected_tile = $request->input('selected_tile');

        $count = 1;
        $search = $request->input('search');
        
        if($search == "")
        {
            $search1 = $request->input('search') . "";
            $vars = DB::select('SELECT * FROM users WHERE orgName IS NULL AND role = "USER" ORDER BY accountCreatedAt DESC');
        }else{
            $search1 = $request->input('search') . "";
            $role = "USER";
            $vars = User::query()
                    ->where('role', $role)
                    ->whereNull('orgName')
                    ->orderBy('accountCreatedAt', 'DESC')
                    ->where(function($query) use ($search){
                        $query->where('firstName', 'LIKE', "%{$search}%")
                            ->orWhere('id', 'LIKE', "{$search}")
                            ->orWhere('middleName', 'LIKE', "%{$search}%")
                            ->orWhere('lastName', 'LIKE', "%{$search}%")
                            ->orWhere('email', 'LIKE', "{$search}")
                            ->orWhere('birthday', 'LIKE', "{$search}")
                            ->orWhere('phoneNumber', 'LIKE', "{$search}")
                            ->orWhere('accountVerified', 'LIKE', "{$search}")
                            ->orWhereRaw(
                                "concat(firstName, ' ', 'middleName', ' ', lastName) like '%" . $search . "%' ")
                            ->orWhereRaw(
                                    "concat(firstName, ' ', lastName) like '%" . $search . "%' ");
                            })
                    ->get();
        }

        $donated = DB::table('posts')
                ->join('transactions', 'posts.postId', '=', 'transactions.transactionPostId')
                ->join('users', 'users.id', '=', 'posts.postUserId')
                ->orderBy('transactionCreatedAt', 'DESC')
                ->get();
        
        $received = DB::table('transactions')
                ->join('users', 'users.id', '=', 'transactions.transactionUserId')
                ->join('posts', 'posts.postId', '=', 'transactions.transactionPostId')
                ->orderBy('transactionCreatedAt', 'DESC')
                ->get();

        $layoutpeople = DB::select('SELECT * FROM users WHERE orgName IS NULL AND role = "USER"');
        $layoutorg = DB::select('SELECT * FROM users WHERE orgName IS NOT NULL AND role = "USER"');
        $layoutpost = DB::select('SELECT * FROM posts');
        $layoutinquiry = DB::select('SELECT * FROM inquiries');
        $layoutreport = DB::select('SELECT * FROM reports');
        $layoutrequest = DB::select('SELECT * FROM reviews');

        return view('admin.userstable', compact('donated','received','vars', 'count', 'search', 'search1', 'selected_tile', 'tiles', 'layoutpeople', 'layoutorg', 'layoutpost', 'layoutinquiry', 'layoutreport', 'layoutrequest'));
        //return view('pdf.adminUsersPDF', compact('vars', 'count', 'search'));
    }

    public function adminOrgsTable(Request $request)
    {
        $tiles = array('Dashboard', 'People', 'Organization', 'Posts', 'Users Inquiries', 'Users Leaderboards', 'Donation Monitoring', 'Requests', 'Reports', 'Logs', 'Settings');
        $selected_tile = $request->input('selected_tile');

        $count = 1;
        $search = $request->input('search');
        if($search == "")
        {
            $vars = DB::select('SELECT * FROM users WHERE orgName IS NOT NULL AND role = "USER" ORDER BY accountCreatedAt DESC');
        }else{
            $role = "USER";
            $vars = User::query()
                    ->where('role', $role)
                    ->whereNotNull('orgName')
                    ->orderBy('accountCreatedAt', 'DESC')
                    ->where(function($query) use ($search){
                        $query->where('orgName', 'LIKE', "%{$search}%")
                            ->orWhere('id', 'LIKE', "{$search}")
                            ->orWhere('middleName', 'LIKE', "%{$search}%")
                            ->orWhere('lastName', 'LIKE', "%{$search}%")
                            ->orWhere('email', 'LIKE', "{$search}")
                            ->orWhere('birthday', 'LIKE', "{$search}")
                            ->orWhere('phoneNumber', 'LIKE', "{$search}")
                            ->orWhere('accountVerified', 'LIKE', "{$search}")
                            ->orWhereRaw(
                                "concat(firstName, ' ', 'middleName', ' ', lastName) like '%" . $search . "%' ")
                            ->orWhereRaw(
                                    "concat(firstName, ' ', lastName) like '%" . $search . "%' ");
                            })
                    ->get();
        }

        $donated = DB::table('posts')
                ->join('transactions', 'posts.postId', '=', 'transactions.transactionPostId')
                ->join('users', 'users.id', '=', 'posts.postUserId')
                ->orderBy('transactionCreatedAt', 'DESC')
                ->get();
        
        $received = DB::table('transactions')
                ->join('users', 'users.id', '=', 'transactions.transactionUserId')
                ->join('posts', 'posts.postId', '=', 'transactions.transactionPostId')
                ->orderBy('transactionCreatedAt', 'DESC')
                ->get();

        $layoutpeople = DB::select('SELECT * FROM users WHERE orgName IS NULL AND role = "USER"');
        $layoutorg = DB::select('SELECT * FROM users WHERE orgName IS NOT NULL AND role = "USER"');
        $layoutpost = DB::select('SELECT * FROM posts');
        $layoutinquiry = DB::select('SELECT * FROM inquiries');
        $layoutreport = DB::select('SELECT * FROM reports');
        $layoutrequest = DB::select('SELECT * FROM reviews');

        return view('admin.orgstable', compact('donated','received','vars', 'count', 'search', 'selected_tile', 'tiles', 'layoutpeople', 'layoutorg', 'layoutpost', 'layoutinquiry', 'layoutreport', 'layoutrequest'));
    }

    public function adminPostsTable(Request $request)
    {
        $tiles = array('Dashboard', 'People', 'Organization', 'Posts', 'Users Inquiries', 'Users Leaderboards', 'Donation Monitoring', 'Requests', 'Reports', 'Logs', 'Settings');
        $selected_tile = $request->input('selected_tile');

        $count = 1;

        $search = $request->input('search');

        if($search == "")
        {
            $vars = Post::query()
            ->join('users', 'users.id', '=', 'posts.postUserId')
            ->orderBy('postCreatedAt', 'DESC')
            ->get();
            $transactions = DB::select('SELECT * FROM recactivities JOIN users ON users.id = recactivities.recactivityBy ORDER BY recactivityCreatedAt DESC');
            $comments = DB::select('SELECT * FROM comments JOIN users ON users.id = comments.commentUserId ORDER BY commentCreatedAt DESC');
        }else{
            $vars = Post::query()
                    ->join('users', 'users.id', '=', 'posts.postUserId')
                    ->orderBy('postCreatedAt', 'DESC')
                    ->where(function($query) use ($search){
                        $query->where('orgName', 'LIKE', "%{$search}%")
                            ->orWhere('postId', 'LIKE', "{$search}")
                            ->orWhere('firstName', 'LIKE', "%{$search}%")
                            ->orWhere('middleName', 'LIKE', "%{$search}%")
                            ->orWhere('lastName', 'LIKE', "%{$search}%")
                            ->orWhere('postCaption', 'LIKE', "%{$search}%")
                            ->orWhere('postStatus', 'LIKE', "%{$search}%")
                            ->orWhereRaw(
                                "concat(firstName, ' ', 'middleName', ' ', lastName) like '%" . $search . "%' ")
                            ->orWhereRaw(
                                    "concat(firstName, ' ', lastName) like '%" . $search . "%' ");
                            })
                    ->get();

            $transactions = DB::select('SELECT * FROM recactivities JOIN users ON users.id = recactivities.recactivityBy ORDER BY recactivityCreatedAt DESC');
            $comments = DB::select('SELECT * FROM comments JOIN users ON users.id = comments.commentUserId ORDER BY commentCreatedAt DESC');
        }

        $layoutpeople = DB::select('SELECT * FROM users WHERE orgName IS NULL AND role = "USER"');
        $layoutorg = DB::select('SELECT * FROM users WHERE orgName IS NOT NULL AND role = "USER"');
        $layoutpost = DB::select('SELECT * FROM posts');
        $layoutinquiry = DB::select('SELECT * FROM inquiries');
        $layoutreport = DB::select('SELECT * FROM reports');
        $layoutrequest = DB::select('SELECT * FROM reviews');
        
        return view('admin.poststable', compact('transactions','vars', 'count', 'search', 'comments', 'selected_tile', 'tiles','layoutpeople', 'layoutorg', 'layoutpost', 'layoutinquiry', 'layoutreport', 'layoutrequest'));
    }

    public function adminSettings(Request $request)
    {
        $tiles = array('Dashboard', 'People', 'Organization', 'Posts', 'Users Inquiries', 'Users Leaderboards', 'Donation Monitoring', 'Requests', 'Reports', 'Logs', 'Settings');
        $selected_tile = $request->input('selected_tile');
        $search = $request->input('search');

        $posts = User::query()
                ->where('id', '=', auth()->user()->id)
                ->first();

        
        $layoutpeople = DB::select('SELECT * FROM users WHERE orgName IS NULL AND role = "USER"');
        $layoutorg = DB::select('SELECT * FROM users WHERE orgName IS NOT NULL AND role = "USER"');
        $layoutpost = DB::select('SELECT * FROM posts');
        $layoutinquiry = DB::select('SELECT * FROM inquiries');
        $layoutreport = DB::select('SELECT * FROM reports');
        $layoutrequest = DB::select('SELECT * FROM reviews');

        return view('admin.settings', compact('selected_tile', 'tiles', 'search','layoutpeople', 'layoutorg', 'layoutpost', 'layoutinquiry', 'layoutreport', 'layoutrequest', 'posts'));
    }

    public function updateProfile(Request $request, $id){

        //$id = auth()->user()->id;
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
    
          return redirect()->back()->with('posts', $posts)->with('success','Wonderful! Changes saved.');
    }

    public function adminList(Request $request)
    {
        $tiles = array('Dashboard', 'People', 'Organization', 'Posts', 'Users Inquiries', 'Users Leaderboards', 'Donation Monitoring', 'Requests', 'Reports', 'Logs', 'Settings');
        $selected_tile = $request->input('selected_tile');
        $search = $request->input('search');

        $vars = User::query()
                ->where('role', '=', 'ADMIN')
                ->orderBy('accountCreatedAt', 'DESC')
                ->get();
        
            $donated = DB::table('posts')
                ->join('transactions', 'posts.postId', '=', 'transactions.transactionPostId')
                ->join('users', 'users.id', '=', 'posts.postUserId')
                ->orderBy('transactionCreatedAt', 'DESC')
                ->get();
        
            $received = DB::table('transactions')
                ->join('users', 'users.id', '=', 'transactions.transactionUserId')
                ->join('posts', 'posts.postId', '=', 'transactions.transactionPostId')
                ->orderBy('transactionCreatedAt', 'DESC')
                ->get();
        
        $layoutpeople = DB::select('SELECT * FROM users WHERE orgName IS NULL AND role = "USER"');
        $layoutorg = DB::select('SELECT * FROM users WHERE orgName IS NOT NULL AND role = "USER"');
        $layoutpost = DB::select('SELECT * FROM posts');
        $layoutinquiry = DB::select('SELECT * FROM inquiries');
        $layoutreport = DB::select('SELECT * FROM reports');
        $layoutrequest = DB::select('SELECT * FROM reviews');

        return view('admin.adminlist', compact('donated', 'received','vars','selected_tile', 'tiles', 'search','layoutpeople', 'layoutorg', 'layoutpost', 'layoutinquiry', 'layoutreport', 'layoutrequest'));
    }

    public function adminRequestsVerify(Request $request)
    {
        $tiles = array('Dashboard', 'People', 'Organization', 'Posts', 'Users Inquiries', 'Users Leaderboards', 'Donation Monitoring', 'Requests', 'Reports', 'Logs', 'Settings');
        $selected_tile = $request->input('selected_tile');
        $search = "";
        $search = $request->input('search');

        if($search == ""){
            $vars = Review::query()
                ->join('users', 'users.id', '=', 'reviews.reviewUserId')
                ->where('reviewType', '=', 'VERIFICATION')
                ->where('users.accountVerified', '=', 'NOT VERIFIED')
                ->orderBy('reviewCreatedAt', 'DESC')
                ->get();

            $donated = DB::table('posts')
                ->join('transactions', 'posts.postId', '=', 'transactions.transactionPostId')
                ->join('users', 'users.id', '=', 'posts.postUserId')
                ->orderBy('transactionCreatedAt', 'DESC')
                ->get();
        
            $received = DB::table('transactions')
                ->join('users', 'users.id', '=', 'transactions.transactionUserId')
                ->join('posts', 'posts.postId', '=', 'transactions.transactionPostId')
                ->orderBy('transactionCreatedAt', 'DESC')
                ->get();
        }else{
            $vars = Review::query()
                ->join('users', 'users.id', '=', 'reviews.reviewUserId')
                ->where('reviewType', '=', 'VERIFICATION')
                ->where('users.accountVerified', '=', 'NOT VERIFIED')
                ->orderBy('reviewCreatedAt', 'DESC')
                ->where(function($query) use ($search){
                    $query->where('orgName', 'LIKE', "%{$search}%")
                        ->orWhere('firstName', 'LIKE', "%{$search}%")
                        ->orWhere('middleName', 'LIKE', "%{$search}%")
                        ->orWhere('lastName', 'LIKE', "%{$search}%")
                        ->orWhere('reviewType', 'LIKE', "%{$search}%")
                        ->orWhere('reviewCreatedAt', 'LIKE', "%{$search}%")
                        ->orWhereRaw(
                            "concat(firstName, ' ', 'middleName', ' ', lastName) like '%" . $search . "%' ")
                        ->orWhereRaw(
                                "concat(firstName, ' ', lastName) like '%" . $search . "%' ");
                        })
                ->get();

            $donated = DB::table('posts')
                ->join('transactions', 'posts.postId', '=', 'transactions.transactionPostId')
                ->join('users', 'users.id', '=', 'posts.postUserId')
                ->orderBy('transactionCreatedAt', 'DESC')
                ->get();
        
            $received = DB::table('transactions')
                ->join('users', 'users.id', '=', 'transactions.transactionUserId')
                ->join('posts', 'posts.postId', '=', 'transactions.transactionPostId')
                ->orderBy('transactionCreatedAt', 'DESC')
                ->get();
        }

        
        $layoutpeople = DB::select('SELECT * FROM users WHERE orgName IS NULL AND role = "USER"');
        $layoutorg = DB::select('SELECT * FROM users WHERE orgName IS NOT NULL AND role = "USER"');
        $layoutpost = DB::select('SELECT * FROM posts');
        $layoutinquiry = DB::select('SELECT * FROM inquiries');
        $layoutreport = DB::select('SELECT * FROM reports');
        $layoutrequest = DB::select('SELECT * FROM reviews');

        return view('admin.requests_verify', compact('vars', 'selected_tile', 'tiles', 'search','layoutpeople', 'layoutorg', 'layoutpost', 'layoutinquiry', 'layoutreport', 'layoutrequest', 'donated','received'));
    }

    public function adminRequestsDelete(Request $request)
    {
        $tiles = array('Dashboard', 'People', 'Organization', 'Posts', 'Users Inquiries', 'Users Leaderboards', 'Donation Monitoring', 'Requests', 'Reports', 'Logs', 'Settings');
        $selected_tile = $request->input('selected_tile');
        $search = "";
        $search = $request->input('search');

        if($search == ""){
            $vars = Review::query()
                ->join('users', 'users.id', '=', 'reviews.reviewUserId')
                ->where('reviewType', '=', 'DELETION')
                ->orderBy('reviewCreatedAt', 'DESC')
                ->get();

            $donated = DB::table('posts')
                ->join('transactions', 'posts.postId', '=', 'transactions.transactionPostId')
                ->join('users', 'users.id', '=', 'posts.postUserId')
                ->orderBy('transactionCreatedAt', 'DESC')
                ->get();
        
            $received = DB::table('transactions')
                ->join('users', 'users.id', '=', 'transactions.transactionUserId')
                ->join('posts', 'posts.postId', '=', 'transactions.transactionPostId')
                ->orderBy('transactionCreatedAt', 'DESC')
                ->get();
        }else{
            $vars = Review::query()
                ->join('users', 'users.id', '=', 'reviews.reviewUserId')
                ->where('reviewType', '=', 'DELETION')
                ->orderBy('reviewCreatedAt', 'DESC')
                ->where(function($query) use ($search){
                    $query->where('orgName', 'LIKE', "%{$search}%")
                        ->orWhere('firstName', 'LIKE', "%{$search}%")
                        ->orWhere('middleName', 'LIKE', "%{$search}%")
                        ->orWhere('lastName', 'LIKE', "%{$search}%")
                        ->orWhere('reviewType', 'LIKE', "%{$search}%")
                        ->orWhere('reviewCreatedAt', 'LIKE', "%{$search}%")
                        ->orWhereRaw(
                            "concat(firstName, ' ', 'middleName', ' ', lastName) like '%" . $search . "%' ")
                        ->orWhereRaw(
                                "concat(firstName, ' ', lastName) like '%" . $search . "%' ");
                        })
                ->get();

            $donated = DB::table('posts')
                ->join('transactions', 'posts.postId', '=', 'transactions.transactionPostId')
                ->join('users', 'users.id', '=', 'posts.postUserId')
                ->orderBy('transactionCreatedAt', 'DESC')
                ->get();
        
            $received = DB::table('transactions')
                ->join('users', 'users.id', '=', 'transactions.transactionUserId')
                ->join('posts', 'posts.postId', '=', 'transactions.transactionPostId')
                ->orderBy('transactionCreatedAt', 'DESC')
                ->get();
        }

        
        $layoutpeople = DB::select('SELECT * FROM users WHERE orgName IS NULL AND role = "USER"');
        $layoutorg = DB::select('SELECT * FROM users WHERE orgName IS NOT NULL AND role = "USER"');
        $layoutpost = DB::select('SELECT * FROM posts');
        $layoutinquiry = DB::select('SELECT * FROM inquiries');
        $layoutreport = DB::select('SELECT * FROM reports');
        $layoutrequest = DB::select('SELECT * FROM reviews');

        return view('admin.requests_delete', compact('vars', 'selected_tile', 'tiles', 'search','layoutpeople', 'layoutorg', 'layoutpost', 'layoutinquiry', 'layoutreport', 'layoutrequest', 'donated','received'));
    }

    public function adminDashboard()
    {
        return view('admin.admindashboard');
    }

    public function adminUserSample()
    {
        return view('admin.adminuser');
    }

    public function adminVerifyUser(Request $request)
    {
        $id = $request->input('userid');
        $post = User::find($id);
          $post ->  accountVerified = "VERIFIED";
          $post->save();
        
          $post2 = new AdminLog;
          $post2 ->  adminloggedBy = auth()->user()->id;
          $post2 -> adminlogUserId = $id;
          $post2 -> adminlogDescription = "VERIFIED";
          $post2 -> adminlogCategory = "PEOPLE/ORGANIZATION";
          $post2->save();

        $post3 = new Notif;
        $post3 -> notifUserId = $id;
        $post3 -> notifToUserId = $id;
        $post3 -> notifType = "verify";
        $post3 -> notifStatus = "UNREAD";
        $post3->save();

          DB::table('reviews')->where(['reviewUserId'=> $id])->where(['reviewType'=> "VERIFICATION"])->delete();

        return redirect()->back();//->with('vars', $vars);
    }

    public function adminVerifyPost(Request $request)
    {
        $userid = $request->input('userid');
        $id = $request->input('postid');
        $post = Post::find($id);
          $post ->  postStatus = "VERIFIED";
          $post->save();

          $post2 = new AdminLog;
          $post2 ->  adminloggedBy = auth()->user()->id;
          $post2 -> adminlogPostId = $id;
          $post2 -> adminlogDescription = "VERIFIED";
          $post2 -> adminlogCategory = "POSTS";
          $post2->save();

        $post3 = new Notif;
        $post3 -> notifUserId = $userid;
        $post3 -> notifToUserId = $userid;
        $post3 -> notifPostId = $id;
        $post3 -> notifType = "verify";
        $post3 -> notifStatus = "UNREAD";
        $post3->save();

        return redirect()->back();//->with('vars', $vars);
    }

    public function stats(Request $request)
    {
        $tiles = array('Dashboard', 'People', 'Organization', 'Posts', 'Users Inquiries', 'Users Leaderboards', 'Donation Monitoring', 'Requests', 'Reports', 'Logs', 'Settings');
        $selected_tile = $request->input('selected_tile');

        $data = DB::table('users')
           ->select(
            DB::raw('barangay as barangay'),
            DB::raw('count(*) as number'))
           ->groupBy('barangay')
           ->get();
        $array[] = ['City', 'Number'];
        foreach($data as $key => $value)
        {
          $array[++$key] = [$value->barangay, $value->number];
        }

        //category
        $data1 = DB::table('posts')
           ->select(
            DB::raw('postCategory as val'),
            DB::raw('count(*) as number'))
           ->groupBy('postCategory')
           ->get();
        $array1[] = ['Category', 'Number'];
        foreach($data1 as $key => $value)
        {
          $array1[++$key] = [$value->val, $value->number];
        }

        //city
        $data2 = DB::table('posts')
           ->select(
            DB::raw('postCity as val'),
            DB::raw('count(*) as number'))
           ->groupBy('postCity')
           ->get();
        $array2[] = ['City', 'Number'];
        foreach($data2 as $key => $value)
        {
          $array2[++$key] = [$value->val, $value->number];
        }

        //barangays of city mandaue
        $data3 = DB::table('posts')
           ->select(
            DB::raw('postBarangay as val'),
            DB::raw('count(*) as number'))
           ->groupBy('postBarangay')
           ->where('postCity', '=', 'Mandaue')
           ->get();
        $array3[] = ['Mandaue Barangays', 'Number'];
        foreach($data3 as $key => $value)
        {
          $array3[++$key] = [$value->val, $value->number];
        }

        //barangays of city lapulapu
        $data4 = DB::table('posts')
           ->select(
            DB::raw('postBarangay as val'),
            DB::raw('count(*) as number'))
           ->groupBy('postBarangay')
           ->where('postCity', '=', 'Lapu-Lapu')
           ->get();
        $array4[] = ['Lapu-Lapu Barangays', 'Number'];
        foreach($data4 as $key => $value)
        {
          $array4[++$key] = [$value->val, $value->number];
        }

        $category = json_encode($array1);
        $city = json_encode($array2);
        $barangay1 = json_encode($array3);
        $barangay2 = json_encode($array4);

        $layoutpeople = DB::select('SELECT * FROM users WHERE orgName IS NULL AND role = "USER"');
        $layoutorg = DB::select('SELECT * FROM users WHERE orgName IS NOT NULL AND role = "USER"');
        $layoutpost = DB::select('SELECT * FROM posts');
        $layoutinquiry = DB::select('SELECT * FROM inquiries');
        $layoutreport = DB::select('SELECT * FROM reports');
        $layoutrequest = DB::select('SELECT * FROM reviews');

        return view('admin.stats', compact('category', 'city', 'barangay1', 'barangay2', 'selected_tile', 'tiles','layoutpeople', 'layoutorg', 'layoutpost', 'layoutinquiry', 'layoutreport', 'layoutrequest'));
    }

    public function adminReportsUsers(Request $request)
    {
        $tiles = array('Dashboard', 'People', 'Organization', 'Posts', 'Users Inquiries', 'Users Leaderboards', 'Donation Monitoring', 'Requests', 'Reports', 'Logs', 'Settings');
        $selected_tile = $request->input('selected_tile');
        $search = $request->input("search");
        $thisperson = []; $person = []; $varse = [];

        if($search == ""){

            $person = Report::query()
                ->join('users', 'users.id', '=', 'reports.reportedBy')
                ->where('reportUserId', '!=', NULL)
                ->orderBy('reportUpdatedAt','DESC')
                ->orderBy('reportStatus','DESC')
                ->get();

            $vars = Report::query()
                ->join('users', 'users.id', '=', 'reports.reportUserId')
                ->where('reportUserId', '!=', NULL)
                ->orderBy('reportUpdatedAt','DESC')
                ->orderBy('reportStatus','DESC')
                ->get();

            $varse = Report::query()
                ->join('users', 'users.id', '=', 'reports.reportUserId')
                ->where('reportUserId', '!=', NULL)
                ->orderBy('reportUpdatedAt','DESC')
                ->orderBy('reportStatus','DESC')
                ->get();

        }else{

            $vars = Report::query()
                ->join('users', 'users.id', '=', 'reports.reportUserId')
                ->where('reportUserId', '!=', NULL)
                ->orderBy('reportUpdatedAt','DESC')
                ->orderBy('reportStatus','DESC')
                ->where(function($query) use ($search){
                    $query->where('orgName', 'LIKE', "%{$search}%")
                        ->orWhere('firstName', 'LIKE', "%{$search}%")
                        ->orWhere('middleName', 'LIKE', "%{$search}%")
                        ->orWhere('lastName', 'LIKE', "%{$search}%")
                        ->orWhere('reportUserId', 'LIKE', "%{$search}%")
                        ->orWhere('reportDescription', 'LIKE', "%{$search}%")
                        ->orWhere('reportStatus', 'LIKE', "%{$search}%")
                        ->orWhereRaw(
                            "concat(firstName, ' ', 'middleName', ' ', lastName) like '%" . $search . "%' ")
                        ->orWhereRaw(
                                "concat(firstName, ' ', lastName) like '%" . $search . "%' ");
                        })
                ->get();

            $varse = "";

            if(count($vars) > 0){

                $person = Report::query()
                    ->join('users', 'users.id', '=', 'reports.reportedBy')
                    ->where('reportUserId', '!=', NULL)
                    ->orderBy('reportUpdatedAt','DESC')
                    ->orderBy('reportStatus','DESC')
                    ->get();
            }

            $person2 = Report::query()
                ->join('users', 'users.id', '=', 'reports.reportedBy')
                ->where('reportUserId', '!=', NULL)
                ->orderBy('reportUpdatedAt','DESC')
                ->orderBy('reportStatus','DESC')
                ->where(function($query) use ($search){
                    $query->where('orgName', 'LIKE', "%{$search}%")
                        ->orWhere('firstName', 'LIKE', "%{$search}%")
                        ->orWhere('middleName', 'LIKE', "%{$search}%")
                        ->orWhere('lastName', 'LIKE', "%{$search}%")
                        ->orWhere('reportUserId', 'LIKE', "%{$search}%")
                        ->orWhere('reportDescription', 'LIKE', "%{$search}%")
                        ->orWhereRaw(
                            "concat(firstName, ' ', 'middleName', ' ', lastName) like '%" . $search . "%' ")
                        ->orWhereRaw(
                                "concat(firstName, ' ', lastName) like '%" . $search . "%' ");
                        })
                ->get();

            if(count($person2) > 0){

                $varse = Report::query()
                    ->join('users', 'users.id', '=', 'reports.reportUserId')
                    ->where('reportUserId', '!=', NULL)
                    ->orderBy('reportUpdatedAt','DESC')
                    ->orderBy('reportStatus','DESC')
                    ->get();
            }
                
            if(count($vars) > 0){
                $thisperson = $person2->diff($vars);
                $thisperson->all();
            }else{
                $thisperson = $person2->diff($vars);
                $thisperson->all();
            }
        }

        $layoutpeople = DB::select('SELECT * FROM users WHERE orgName IS NULL AND role = "USER"');
        $layoutorg = DB::select('SELECT * FROM users WHERE orgName IS NOT NULL AND role = "USER"');
        $layoutpost = DB::select('SELECT * FROM posts');
        $layoutinquiry = DB::select('SELECT * FROM inquiries');
        $layoutreport = DB::select('SELECT * FROM reports');
        $layoutrequest = DB::select('SELECT * FROM reviews');

        return view('admin.adminreports_users', compact('selected_tile', 'tiles', 'search', 'vars', 'varse', 'person', 'thisperson','layoutpeople', 'layoutorg', 'layoutpost', 'layoutinquiry', 'layoutreport', 'layoutrequest'));
    }

    public function make_admin(Request $request){
        $id = $request->input('usertoadminid');
        $post = User::find($id);
        $post ->  role = "ADMIN";
        $post->save();

        $post2 = new AdminLog;
        $post2 ->  adminloggedBy = auth()->user()->id;
        $post2 -> adminlogUserId = $id;
        $post2 -> adminlogDescription = "PROMOTED";
        $post2 -> adminlogCategory = "PEOPLE/ORGANIZATION";
        $post2->save();

        return redirect()->back();
    }

    public function adminReportsPosts(Request $request)
    {
        $tiles = array('Dashboard', 'People', 'Organization', 'Posts', 'Users Inquiries', 'Users Leaderboards', 'Donation Monitoring', 'Requests', 'Reports', 'Logs', 'Settings');
        $selected_tile = $request->input('selected_tile');
        $search = $request->input("search");
        $thisperson = []; $person = []; $varse = [];

        if($search == ""){

            $person = Report::query()
                ->join('users', 'users.id', '=', 'reports.reportedBy')
                ->where('reportPostId', '!=', NULL)
                ->orderBy('reportUpdatedAt','DESC')
                ->orderBy('reportStatus','DESC')
                ->get();

            $vars = Report::query()
                ->join('posts', 'posts.postId', '=', 'reports.reportPostId')
                ->join('users', 'users.id', '=', 'posts.postUserId')
                ->where('reportPostId', '!=', NULL)
                ->orderBy('reportUpdatedAt','DESC')
                ->orderBy('reportStatus','DESC')
                ->get();

            $varse = Report::query()
                    ->join('posts', 'posts.postId', '=', 'reports.reportPostId')
                    ->join('users', 'users.id', '=', 'posts.postUserId')
                    ->where('reportPostId', '!=', NULL)
                    ->orderBy('reportUpdatedAt','DESC')
                    ->orderBy('reportStatus','DESC')
                    ->get();

        }else{

            $vars = Report::query()
                ->join('posts', 'posts.postId', '=', 'reports.reportPostId')
                ->join('users', 'users.id', '=', 'posts.postUserId')
                ->where('reportPostId', '!=', NULL)
                ->orderBy('reportUpdatedAt','DESC')
                ->orderBy('reportStatus','DESC')
                ->where(function($query) use ($search){
                    $query->where('orgName', 'LIKE', "%{$search}%")
                        ->orWhere('firstName', 'LIKE', "%{$search}%")
                        ->orWhere('middleName', 'LIKE', "%{$search}%")
                        ->orWhere('lastName', 'LIKE', "%{$search}%")
                        ->orWhere('postCaption', 'LIKE', "%{$search}%")
                        ->orWhere('reportPostId', 'LIKE', "%{$search}%")
                        ->orWhere('reportDescription', 'LIKE', "%{$search}%")
                        ->orWhere('reportStatus', 'LIKE', "%{$search}%")
                        ->orWhereRaw(
                            "concat(firstName, ' ', 'middleName', ' ', lastName) like '%" . $search . "%' ")
                        ->orWhereRaw(
                                "concat(firstName, ' ', lastName) like '%" . $search . "%' ");
                        })
                ->get();
            
            if(count($vars) > 0){
                $person = Report::query()
                    ->join('users', 'users.id', '=', 'reports.reportedBy')
                    ->where('reportPostId', '!=', NULL)
                    ->orderBy('reportUpdatedAt','DESC')
                    ->orderBy('reportStatus','DESC')
                    ->get();
            }

            

            $person2 = Report::query()
                ->join('users', 'users.id', '=', 'reports.reportedBy')
                ->where('reportPostId', '!=', NULL)
                ->orderBy('reportUpdatedAt','DESC')
                ->orderBy('reportStatus','DESC')
                ->where(function($query) use ($search){
                    $query->where('orgName', 'LIKE', "%{$search}%")
                        ->orWhere('firstName', 'LIKE', "%{$search}%")
                        ->orWhere('middleName', 'LIKE', "%{$search}%")
                        ->orWhere('lastName', 'LIKE', "%{$search}%")
                        ->orWhere('reportPostId', 'LIKE', "%{$search}%")
                        ->orWhere('reportDescription', 'LIKE', "%{$search}%")
                        ->orWhereRaw(
                            "concat(firstName, ' ', 'middleName', ' ', lastName) like '%" . $search . "%' ")
                        ->orWhereRaw(
                                "concat(firstName, ' ', lastName) like '%" . $search . "%' ");
                        })
                ->get();

            if(count($person2) > 0){
                $varse = Report::query()
                    ->join('posts', 'posts.postId', '=', 'reports.reportPostId')
                    ->join('users', 'users.id', '=', 'posts.postUserId')
                    ->where('reportPostId', '!=', NULL)
                    ->orderBy('reportUpdatedAt','DESC')
                    ->orderBy('reportStatus','DESC')
                    ->get();
            }

            if(count($vars) > 0){
                $thisperson = $person2->diff($vars);
                $thisperson->all();
            }else{
                $thisperson = $person2->diff($vars);
                $thisperson->all();
            }
        }

        $layoutpeople = DB::select('SELECT * FROM users WHERE orgName IS NULL AND role = "USER"');
        $layoutorg = DB::select('SELECT * FROM users WHERE orgName IS NOT NULL AND role = "USER"');
        $layoutpost = DB::select('SELECT * FROM posts');
        $layoutinquiry = DB::select('SELECT * FROM inquiries');
        $layoutreport = DB::select('SELECT * FROM reports');
        $layoutrequest = DB::select('SELECT * FROM reviews');

        return view('admin.adminreports_posts', compact('selected_tile', 'tiles', 'search', 'vars', 'varse', 'person', 'thisperson','layoutpeople', 'layoutorg', 'layoutpost', 'layoutinquiry', 'layoutreport', 'layoutrequest'));
    }

    public function adminReportsComments(Request $request)
    {
        $tiles = array('Dashboard', 'People', 'Organization', 'Posts', 'Users Inquiries', 'Users Leaderboards', 'Donation Monitoring', 'Requests', 'Reports', 'Logs', 'Settings');
        $selected_tile = $request->input('selected_tile');
        $search = $request->input("search");

        $comment = ""; $post = ""; $person = "";
        $comment2 = ""; $post2 = []; $person2 = ""; $thisperson = []; $thiscomment = [];
        $comment3 = ""; $post3 = ""; $person3 = []; $thispost = [];
        $c = ""; $p = ""; $pe = ""; $all = [];

        if($search == ""){

            $person = Report::query()
                ->join('users', 'users.id', '=', 'reports.reportedBy')
                ->where('reportCommentId', '!=', NULL)
                ->orderBy('reportUpdatedAt','DESC')
                ->orderBy('reportStatus','DESC')
                ->get();

            $comment = Report::query()
                ->join('comments', 'comments.commentId', '=', 'reports.reportCommentId')
                ->join('users', 'users.id', '=', 'comments.commentUserId')
                ->where('reportCommentId', '!=', NULL)
                ->orderBy('reportUpdatedAt','DESC')
                ->orderBy('reportStatus','DESC')
                ->get();
            
            $post = Report::query()
                ->join('comments', 'comments.commentId', '=', 'reports.reportCommentId')
                ->join('posts', 'posts.postId', '=', 'comments.commentPostId')
                ->join('users', 'users.id', '=', 'posts.postUserId')
                ->where('reportCommentId', '!=', NULL)
                ->orderBy('reportUpdatedAt','DESC')
                ->orderBy('reportStatus','DESC')
                ->get();


            $c = count($comment); $p = count($post); $pe = count($person);

        }else{
            
            $comment = Report::query()
                ->join('comments', 'comments.commentId', '=', 'reports.reportCommentId')
                ->join('users', 'users.id', '=', 'comments.commentUserId')
                ->where('reportCommentId', '!=', NULL)
                ->orderBy('reportUpdatedAt','DESC')
                ->orderBy('reportStatus','DESC')
                ->where(function($query) use ($search){
                    $query->where('orgName', 'LIKE', "%{$search}%")
                        ->orWhere('firstName', 'LIKE', "%{$search}%")
                        ->orWhere('middleName', 'LIKE', "%{$search}%")
                        ->orWhere('lastName', 'LIKE', "%{$search}%")
                        ->orWhere('commentDescription', 'LIKE', "%{$search}%")
                        ->orWhere('reportCommentId', 'LIKE', "%{$search}%")
                        ->orWhere('reportDescription', 'LIKE', "%{$search}%")
                        ->orWhere('reportStatus', 'LIKE', "%{$search}%")
                        ->orWhereRaw(
                            "concat(firstName, ' ', 'middleName', ' ', lastName) like '%" . $search . "%' ")
                        ->orWhereRaw(
                                "concat(firstName, ' ', lastName) like '%" . $search . "%' ");
                        })
                ->get();

            if(count($comment) > 0){
            
                $person = Report::query()
                    ->join('users', 'users.id', '=', 'reports.reportedBy')
                    ->where('reportCommentId', '!=', NULL)
                    ->orderBy('reportUpdatedAt','DESC')
                    ->orderBy('reportStatus','DESC')
                    ->get();

                
                $post = Report::query()
                    ->join('comments', 'comments.commentId', '=', 'reports.reportCommentId')
                    ->join('posts', 'posts.postId', '=', 'comments.commentPostId')
                    ->join('users', 'users.id', '=', 'posts.postUserId')
                    ->where('reportCommentId', '!=', NULL)
                    ->orderBy('reportUpdatedAt','DESC')
                    ->orderBy('reportStatus','DESC')
                    ->get();
            }

            

            



            $post2 = Report::query()
                ->join('comments', 'comments.commentId', '=', 'reports.reportCommentId')
                ->join('posts', 'posts.postId', '=', 'comments.commentPostId')
                ->join('users', 'users.id', '=', 'posts.postUserId')
                ->where('reportCommentId', '!=', NULL)
                ->orderBy('reportUpdatedAt','DESC')
                ->orderBy('reportStatus','DESC')
                ->where(function($query) use ($search){
                        $query->where('orgName', 'LIKE', "%{$search}%")
                            ->orWhere('firstName', 'LIKE', "%{$search}%")
                            ->orWhere('middleName', 'LIKE', "%{$search}%")
                            ->orWhere('lastName', 'LIKE', "%{$search}%")
                            ->orWhereRaw(
                                "concat(firstName, ' ', 'middleName', ' ', lastName) like '%" . $search . "%' ")
                            ->orWhereRaw(
                                    "concat(firstName, ' ', lastName) like '%" . $search . "%' ");
                            })
                ->get();

            if(count($post2) > 0){

                $person2 = Report::query()
                    ->join('users', 'users.id', '=', 'reports.reportedBy')
                    ->where('reportCommentId', '!=', NULL)
                    ->orderBy('reportUpdatedAt','DESC')
                    ->orderBy('reportStatus','DESC')
                    ->get();
                
                
                $comment2 = Report::query()
                    ->join('comments', 'comments.commentId', '=', 'reports.reportCommentId')
                    ->join('users', 'users.id', '=', 'comments.commentUserId')
                    ->where('reportCommentId', '!=', NULL)
                    ->orderBy('reportUpdatedAt','DESC')
                    ->orderBy('reportStatus','DESC')
                    ->get();
            }

            




            $person3 = Report::query()
                ->join('users', 'users.id', '=', 'reports.reportedBy')
                ->where('reportCommentId', '!=', NULL)
                ->orderBy('reportUpdatedAt','DESC')
                ->orderBy('reportStatus','DESC')
                ->where(function($query) use ($search){
                        $query->where('orgName', 'LIKE', "%{$search}%")
                            ->orWhere('firstName', 'LIKE', "%{$search}%")
                            ->orWhere('middleName', 'LIKE', "%{$search}%")
                            ->orWhere('lastName', 'LIKE', "%{$search}%")
                            ->orWhereRaw(
                                "concat(firstName, ' ', 'middleName', ' ', lastName) like '%" . $search . "%' ")
                            ->orWhereRaw(
                                    "concat(firstName, ' ', lastName) like '%" . $search . "%' ");
                            })
                ->get();
        

            if(count($person3) > 0){

                $post3 = Report::query()
                    ->join('comments', 'comments.commentId', '=', 'reports.reportCommentId')
                    ->join('posts', 'posts.postId', '=', 'comments.commentPostId')
                    ->join('users', 'users.id', '=', 'posts.postUserId')
                    ->where('reportCommentId', '!=', NULL)
                    ->orderBy('reportUpdatedAt','DESC')
                    ->orderBy('reportStatus','DESC')
                    ->get();
            
                $comment3 = Report::query()
                    ->join('comments', 'comments.commentId', '=', 'reports.reportCommentId')
                    ->join('users', 'users.id', '=', 'comments.commentUserId')
                    ->where('reportCommentId', '!=', NULL)
                    ->orderBy('reportUpdatedAt','DESC')
                    ->orderBy('reportStatus','DESC')
                    ->get();

            }



            if(count($comment) > 0){

                if(count($post2) > 0){
                    $thispost = $post2->diff($comment);
                    $thispost->all();

                    $thisperson = $person3->diff($thispost)->diff($comment);
                    $thisperson->all();
                }else{
                    $thispost = $post2->diff($comment);
                    $thispost->all();

                    $thisperson = $person3->diff($thispost)->diff($comment);
                    $thisperson->all();
                }
                
            }else{

                if(count($post2) > 0){
                    $thispost = $post2->diff($comment);
                    $thispost->all();

                    $thisperson = $person3->diff($thispost)->diff($comment);
                    $thisperson->all();
                }else{
                    $thispost = $post2->diff($comment);
                    $thispost->all();

                    $thisperson = $person3->diff($thispost)->diff($comment);
                    $thisperson->all();
                }
            }

            $all = $comment->merge($thispost)->merge($thisperson);
            $all->all();
        
            

            
            $c = count($comment); $p = count($post2); $pe = count($person3);

        }

        $layoutpeople = DB::select('SELECT * FROM users WHERE orgName IS NULL AND role = "USER"');
        $layoutorg = DB::select('SELECT * FROM users WHERE orgName IS NOT NULL AND role = "USER"');
        $layoutpost = DB::select('SELECT * FROM posts');
        $layoutinquiry = DB::select('SELECT * FROM inquiries');
        $layoutreport = DB::select('SELECT * FROM reports');
        $layoutrequest = DB::select('SELECT * FROM reviews');

        return view('admin.adminreports_comments', compact('selected_tile', 'tiles', 'search', 'post', 'comment', 'person', 'post2', 'comment2', 'person2', 'post3', 'comment3', 'person3', 'c', 'p', 'pe', 'thispost', 'thisperson','all','layoutpeople', 'layoutorg', 'layoutpost', 'layoutinquiry', 'layoutreport', 'layoutrequest'));
    }

    public function adminLayout(Request $request)
    {
        $layoutpeople = DB::select('SELECT * FROM users WHERE orgName IS NULL AND role = "USER"');
        $layoutorg = DB::select('SELECT * FROM users WHERE orgName IS NOT NULL AND role = "USER"');
        $layoutpost = DB::select('SELECT * FROM posts');
        $layoutinquiry = DB::select('SELECT * FROM inquiries');
        $layoutreport = DB::select('SELECT * FROM reports');
        $layoutrequest = DB::select('SELECT * FROM reviews');

        return view('layouts.admin_layout', compact('layoutpeople', 'layoutorg', 'layoutpost', 'layoutinquiry', 'layoutreport', 'layoutrequest'));
    }

    public function deleteSelected(Request $request)
    {
        $deleteUser = "";
        $deletePost = "";
        $deleteComment = "";
        $deleteUser = $request->input('deleteUser');
        $deletePost = $request->input('deletePost');
        $deleteComment = $request->input('deleteComment');
        $reportid = $request->input('reportid');

        if($deleteUser != ""){
            
            DB::table('users')->where(['id'=> $deleteUser])->delete();

            DB::table('comments')->where(['commentUserId'=> $deleteUser])->delete();
            DB::table('follows')->where(['followUserId'=> $deleteUser])->delete();
            DB::table('follows')->where(['followedUserId'=> $deleteUser])->delete();
            DB::table('inquiries')->where(['inquiryUserId'=> $deleteUser])->delete();
            DB::table('inquiries')->where(['inquirySentToId'=> $deleteUser])->delete();
            DB::table('likes')->where(['likeUserId'=> $deleteUser])->delete();
            DB::table('posts')->where(['postUserId'=> $deleteUser])->delete();
            DB::table('recactivities')->where(['recactivityBy'=> $deleteUser])->delete();
            DB::table('recactivities')->where(['recactivityUserId'=> $deleteUser])->delete();
            DB::table('reports')->where(['reportedBy'=> $deleteUser])->delete();
            DB::table('reports')->where(['reportUserId'=> $deleteUser])->delete();
            DB::table('transactions')->where(['transactionUserId'=> $deleteUser])->delete();

            $post = new AdminLog;
            $post ->  adminloggedBy = auth()->user()->id;
            $post -> adminlogUserId = $deleteUser;
            $post -> adminlogDescription = "DELETED";
            $post -> adminlogCategory = "Manage Reports";
            $post->save();
        }

        if($deletePost != ""){
            DB::table('posts')->where(['postId'=> $deletePost])->delete();
            //DB::table('comments')->where(['commentPostId'=> $c->deletePost])->delete();
            
            DB::table('comments')->where(['commentPostId'=> $deletePost])->delete();
            DB::table('likes')->where(['likePostId'=> $deletePost])->delete();
            DB::table('recactivities')->where(['recactivityPostId'=> $deletePost])->delete();
            DB::table('reports')->where(['reportPostId'=> $deletePost])->delete();
            DB::table('transactions')->where(['transactionPostId'=> $deletePost])->delete();


            $post = new AdminLog;
            $post ->  adminloggedBy = auth()->user()->id;
            $post -> adminlogPostId = $deletePost;
            $post -> adminlogDescription = "DELETED";
            $post -> adminlogCategory = "Manage Reports";
            $post->save();
        }

        if($deleteComment != ""){
            DB::table('comments')->where(['commentId'=> $deleteComment])->delete();

            DB::table('reports')->where(['reportCommentId'=> $deleteComment])->delete();

            $post = new AdminLog;
            $post ->  adminloggedBy = auth()->user()->id;
            $post -> adminlogCommentId = $deleteComment;
            $post -> adminlogDescription = "DELETED";
            $post -> adminlogCategory = "Manage Reports";
            $post->save();
        }

        return redirect()->back();
    }

    public function adminBan(Request $request)
    {
        $deleteUser = "";
        $deletePost = "";
        $deleteComment = "";
        $deleteUser = $request->input('deleteUser');
        $deletePost = $request->input('deletePost');
        $deleteComment = $request->input('deleteComment');
        $reportid = $request->input('reportid');

        if($deleteUser != ""){
            $post = User::find($deleteUser);
            $post ->  accountVerified = "BANNED";
            $post->save();

            $post = Report::find($reportid);
            $post ->  reportStatus = "REVIEWED";
            $post->save();

            $post = new AdminLog;
            $post ->  adminloggedBy = auth()->user()->id;
            $post -> adminlogUserId = $deleteUser;
            $post -> adminlogDescription = "BANNED";
            $post -> adminlogCategory = "Manage Reports";
            $post->save();
        }

        if($deletePost != ""){
            $post = Post::find($deletePost);
            $post ->  postStatus = "BANNED";
            $post->save();

            $post = Report::find($reportid);
            $post ->  reportStatus = "REVIEWED";
            $post->save();

            $post = new AdminLog;
            $post ->  adminloggedBy = auth()->user()->id;
            $post -> adminlogPostId = $deletePost;
            $post -> adminlogDescription = "BANNED";
            $post -> adminlogCategory = "Manage Reports";
            $post->save();
        }

        if($deleteComment != ""){
            DB::table('comments')->where(['commentId'=> $deleteComment])->delete();
        }

        return redirect()->back();
    }

    public function adminLeaderboards(Request $request){

        $tiles = array('Dashboard', 'People', 'Organization', 'Posts', 'Users Inquiries', 'Users Leaderboards', 'Donation Monitoring', 'Requests', 'Reports', 'Logs', 'Settings');
        $selected_tile = $request->input('selected_tile');
        $search = $request->input("search");

        if($request->get('selectbarangay') != ""){
            $selectbarangay = $request->get('selectbarangay');
          }else{
            $selectbarangay = "All";
          }
    
          if($request->get('selectcity') != ""){
            $selectcity = $request->get('selectcity');
          }else{
            $selectcity = "All";
          }
    
          if($request->get('selectprovince') != ""){
            $selectprovince = $request->get('selectprovince');
          }else{
            $selectprovince = "Cebu";
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
          
            if($search == ""){
                if($selectcity == "All" && $selectbarangay == "All"){
                    $vars = DB::select('SELECT * FROM users WHERE role != "ADMIN" AND amountGiven != 0 AND province = "'.$selectprovince.'" ORDER BY amountGiven DESC LIMIT 20');
                }else if($selectcity != "All" && $selectbarangay == "All"){
                    $vars = DB::select('SELECT * FROM users WHERE role != "ADMIN" AND amountGiven != 0 AND city = "'.$selectcity.'" AND province = "'.$selectprovince.'" ORDER BY amountGiven DESC LIMIT 20');
                }else if($selectcity != "All" && $selectbarangay != "All"){
                    $vars = DB::select('SELECT * FROM users WHERE role != "ADMIN" AND amountGiven != 0 AND barangay = "'.$selectbarangay.'" AND city = "'.$selectcity.'" AND province = "'.$selectprovince.'" ORDER BY amountGiven DESC LIMIT 20');
                }
            }else{
                
                if($selectcity == "All" && $selectbarangay == "All"){
                    $vars = User::query()
                        ->where('role', '!=', "ADMIN")
                        ->where('amountGiven', '!=', 0)
                        ->where('province', '=', $selectprovince)
                        ->where(function($query) use ($search){
                            $query->where('orgName', 'LIKE', "%{$search}%")
                                ->orWhere('firstName', 'LIKE', "%{$search}%")
                                ->orWhere('middleName', 'LIKE', "%{$search}%")
                                ->orWhere('lastName', 'LIKE', "%{$search}%")
                                ->orWhereRaw(
                                    "concat(firstName, ' ', 'middleName', ' ', lastName) like '%" . $search . "%' ")
                                ->orWhereRaw(
                                        "concat(firstName, ' ', lastName) like '%" . $search . "%' ");
                                })
                        ->orderBy('amountGiven','DESC')
                        ->skip(0)->take(20)
                        ->get();
                }else if($selectcity != "All" && $selectbarangay == "All"){
                    $vars = User::query()
                        ->where('role', '!=', "ADMIN")
                        ->where('amountGiven', '!=', 0)
                        ->where('province', '=', $selectprovince)
                        ->where('city', '=', $selectcity)
                        ->where(function($query) use ($search){
                            $query->where('orgName', 'LIKE', "%{$search}%")
                                ->orWhere('firstName', 'LIKE', "%{$search}%")
                                ->orWhere('middleName', 'LIKE', "%{$search}%")
                                ->orWhere('lastName', 'LIKE', "%{$search}%")
                                ->orWhereRaw(
                                    "concat(firstName, ' ', 'middleName', ' ', lastName) like '%" . $search . "%' ")
                                ->orWhereRaw(
                                        "concat(firstName, ' ', lastName) like '%" . $search . "%' ");
                                })
                        ->orderBy('amountGiven','DESC')
                        ->skip(0)->take(3)
                        ->get();
                }else if($selectcity != "All" && $selectbarangay != "All"){
                    $vars = User::query()
                        ->where('role', '!=', "ADMIN")
                        ->where('amountGiven', '!=', 0)
                        ->where('province', '=', $selectprovince)
                        ->where('city', '=', $selectcity)
                        ->where('barangay', '=', $selectbarangay)
                        ->where(function($query) use ($search){
                            $query->where('orgName', 'LIKE', "%{$search}%")
                                ->orWhere('firstName', 'LIKE', "%{$search}%")
                                ->orWhere('middleName', 'LIKE', "%{$search}%")
                                ->orWhere('lastName', 'LIKE', "%{$search}%")
                                ->orWhereRaw(
                                    "concat(firstName, ' ', 'middleName', ' ', lastName) like '%" . $search . "%' ")
                                ->orWhereRaw(
                                        "concat(firstName, ' ', lastName) like '%" . $search . "%' ");
                                })
                        ->orderBy('amountGiven','DESC')
                        ->skip(0)->take(20)
                        ->get();
                }
            }


            $layoutpeople = DB::select('SELECT * FROM users WHERE orgName IS NULL AND role = "USER"');
            $layoutorg = DB::select('SELECT * FROM users WHERE orgName IS NOT NULL AND role = "USER"');
            $layoutpost = DB::select('SELECT * FROM posts');
            $layoutinquiry = DB::select('SELECT * FROM inquiries');
            $layoutreport = DB::select('SELECT * FROM reports');
            $layoutrequest = DB::select('SELECT * FROM reviews');
            
  
        return view('admin.adminleaderboards', compact('selected_tile', 'tiles', 'vars', 'array', 'b1', 'b2', 'selectbarangay', 'selectcity', 'selectprovince', 'search','layoutpeople', 'layoutorg', 'layoutpost', 'layoutinquiry', 'layoutreport', 'layoutrequest'));
      }

      public function adminLogs(Request $request){
            $tiles = array('Dashboard', 'People', 'Organization', 'Posts', 'Users Inquiries', 'Users Leaderboards', 'Donation Monitoring', 'Requests', 'Reports', 'Logs', 'Settings');
            $selected_tile = $request->input('selected_tile');
            $search = $request->input('search');

            if($search == ""){
                $vars = Adminlog::query()
                    ->join('users', 'users.id', '=', 'adminlogs.adminloggedBy')
                    ->orderBy('adminlogCreatedAt','DESC')
                    ->get();
            }else{
                $vars = Adminlog::query()
                    ->join('users', 'users.id', '=', 'adminlogs.adminloggedBy')
                    ->orderBy('adminlogCreatedAt','DESC')
                    ->where(function($query) use ($search){
                        $query->where('orgName', 'LIKE', "%{$search}%")
                            ->orWhere('firstName', 'LIKE', "%{$search}%")
                            ->orWhere('middleName', 'LIKE', "%{$search}%")
                            ->orWhere('lastName', 'LIKE', "%{$search}%")
                            ->orWhere('adminlogUserId', 'LIKE', "%{$search}%")
                            ->orWhere('adminlogPostId', 'LIKE', "%{$search}%")
                            ->orWhere('adminlogCommentId', 'LIKE', "%{$search}%")
                            ->orWhere('adminlogCreatedAt', 'LIKE', "%{$search}%")
                            ->orWhereRaw(
                                "concat(firstName, ' ', 'middleName', ' ', lastName) like '%" . $search . "%' ")
                            ->orWhereRaw(
                                    "concat(firstName, ' ', lastName) like '%" . $search . "%' ");
                            })
                    ->get();
            }
            
            $layoutpeople = DB::select('SELECT * FROM users WHERE orgName IS NULL AND role = "USER"');
            $layoutorg = DB::select('SELECT * FROM users WHERE orgName IS NOT NULL AND role = "USER"');
            $layoutpost = DB::select('SELECT * FROM posts');
            $layoutinquiry = DB::select('SELECT * FROM inquiries');
            $layoutreport = DB::select('SELECT * FROM reports');
            $layoutrequest = DB::select('SELECT * FROM reviews');

            return view('admin.logs', compact('selected_tile', 'tiles', 'search', 'vars','layoutpeople', 'layoutorg', 'layoutpost', 'layoutinquiry', 'layoutreport', 'layoutrequest'));
      }

      public function reviewComment(Request $request)
    {
        $deleteUser = "";
        $deletePost = "";
        $deleteComment = "";
        $deleteUser = $request->input('deleteUser');
        $deletePost = $request->input('deletePost');
        $deleteComment = $request->input('deleteComment');
        $reportid = $request->input('reportid');

        if($deleteUser != ""){
            $post = User::find($deleteUser);
            $post ->  accountVerified = "BANNED";
            $post->save();

            $post = Report::find($reportid);
            $post ->  reportStatus = "REVIEWED";
            $post->save();

            $post = new AdminLog;
            $post ->  adminloggedBy = auth()->user()->id;
            $post -> adminlogUserId = $deleteUser;
            $post -> adminlogDescription = "BANNED";
            $post -> adminlogCategory = "Manage Reports";
            $post->save();
        }

        if($deletePost != ""){
            $post = Post::find($deletePost);
            $post ->  postStatus = "BANNED";
            $post->save();

            $post = Report::find($reportid);
            $post ->  reportStatus = "REVIEWED";
            $post->save();

            $post = new AdminLog;
            $post ->  adminloggedBy = auth()->user()->id;
            $post -> adminlogPostId = $deletePost;
            $post -> adminlogDescription = "BANNED";
            $post -> adminlogCategory = "Manage Reports";
            $post->save();
        }

        if($deleteComment != ""){

            $post = Report::find($reportid);
            $post ->  reportStatus = "REVIEWED";
            $post->save();

            $post = new AdminLog;
            $post ->  adminloggedBy = auth()->user()->id;
            $post -> adminlogCommentId = $deleteComment;
            $post -> adminlogDescription = "REVIEWED";
            $post -> adminlogCategory = "Manage Reports";
            $post->save();
        }

        return redirect()->back();
    }
}
