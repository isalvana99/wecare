<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\User;
use App\Models\AdminLog;
use DB;

class InquiryController extends Controller
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
        //
    }

    public function show1()
    {
        $vars = DB::select('SELECT * FROM inquiries JOIN users on users.id = inquiryUserId WHERE inquiryMessage != "" ORDER BY inquiryCreatedAt DESC');
        return view('messages.user_inquiries', compact('vars'));
    }

    public function inquiryUser(Request $request){
        //$vars = DB::select('SELECT * FROM inquiries JOIN users on users.id = inquiryUserId');
        $adminid = $request->input('receiverid');
        $adminid == '' ? "1" : $request->input('receiverid');
        
        if($request->input('inquirymessage') != ""){
            $post = new Inquiry;
            $post -> inquiryUserId = auth()->user()->id;
            $post -> inquirySentToId = $adminid;
            $post -> inquiryMessage = $request->input('inquirymessage');
            $post -> inquiryStatus = "UNREAD";
            $post->save();
        }
        
        return redirect()->back();
        //return view('messages.user_inquiries', compact('vars'));
    }

    public function show2(Request $request)
    {
        $tiles = array('Dashboard', 'People', 'Organization', 'Posts', 'Users Inquiries', 'Users Leaderboards', 'Donation Monitoring', 'Requests', 'Reports', 'Logs', 'Settings');
        $selected_tile = $request->input('selected_tile');

        $selected_from_all = "";
        $selected_person_id = $request->input('selected_person_id');
        $selected_from_all = $request->input('selected_from_all');
        $search = $request->input('searchmsg');
        $count = 1;
        $count2 = 1;
        $count3 = 1;

        if($selected_person_id != ""){
            $count = 2;
            $count2 = 2;
        }


        $msgid = $request->input('msgid');

        $vars = Inquiry::query()
                ->join('users', 'users.id', '=', 'inquiries.inquiryUserId')
                ->orderBy('inquiries.inquiryCreatedAt', 'DESC')
                ->get();

        foreach($vars as $v){
            if($v->inquiryStatus == "UNREAD" && $v->inquiryUserId == $selected_person_id){

                $updatemsg = Inquiry::find($v->inquiryId);
                $updatemsg ->  inquiryStatus = "READ";
                $updatemsg->save();
            }
            
        }
        
        //search
        if($search == ""){

            $people = Inquiry::query()
                ->join('users', 'users.id', '=', 'inquiries.inquiryUserId')
                ->where('inquiries.inquiryUserId', '!=', auth()->user()->id)
                ->where('users.role', '!=', "ADMIN")
                ->orderBy('inquiries.inquiryCreatedAt', 'DESC')
                ->get();

            $unique = $people->unique('inquiryUserId');

            $unique->values()->all();

            $all = DB::select('SELECT * FROM users WHERE role = "USER"');

        }else{
        
            $people = Inquiry::query()
                ->join('users', 'users.id', '=', 'inquiries.inquiryUserId')
                ->where('users.role', '!=', "ADMIN")
                ->where('inquiries.inquiryUserId', '!=', auth()->user()->id)
                ->orderBy('inquiries.inquiryCreatedAt', 'DESC')
                ->where(function($query) use ($search){
                    $query->where('orgName', 'LIKE', "%{$search}%")
                        ->orWhere('firstName', 'LIKE', "%{$search}%")
                        ->orWhere('middleName', 'LIKE', "%{$search}%")
                        ->orWhere('lastName', 'LIKE', "%{$search}%")
                        ->orWhere('id', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "{$search}")
                        ->orWhereRaw(
                            "concat(firstName, ' ', 'middleName', ' ', lastName) like '%" . $search . "%' ")
                        ->orWhereRaw(
                                "concat(firstName, ' ', lastName) like '%" . $search . "%' ");
                        })
                ->get();

            $unique = $people->unique('inquiryUserId');

            $unique->values()->all();

            $all = User::query()
                ->where('users.role', '!=', "ADMIN")
                ->where(function($query) use ($search){
                    $query->where('orgName', 'LIKE', "%{$search}%")
                        ->orWhere('firstName', 'LIKE', "%{$search}%")
                        ->orWhere('middleName', 'LIKE', "%{$search}%")
                        ->orWhere('lastName', 'LIKE', "%{$search}%")
                        ->orWhere('id', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "{$search}")
                        ->orWhereRaw(
                            "concat(firstName, ' ', 'middleName', ' ', lastName) like '%" . $search . "%' ")
                        ->orWhereRaw(
                                "concat(firstName, ' ', lastName) like '%" . $search . "%' ");
                        })
                ->get();
            
        }

        $selected_person = Inquiry::query()
                        ->join('users', 'users.id', '=', 'inquiries.inquiryUserId')
                        ->where('inquiries.inquiryUserId', '!=', 1)
                        ->groupBy('inquiryUserId')
                        ->orderBy('inquiries.inquiryCreatedAt', 'DESC')
                        ->first();

        $date = Inquiry::query()
                ->join('users', 'users.id', '=', 'inquiries.inquiryUserId')
                ->orderBy('inquiries.inquiryCreatedAt', 'ASC')
                ->groupBy('inquiries.inquiryCreatedAt')
                ->get();

        $layoutpeople = DB::select('SELECT * FROM users WHERE orgName IS NULL AND role = "USER"');
        $layoutorg = DB::select('SELECT * FROM users WHERE orgName IS NOT NULL AND role = "USER"');
        $layoutpost = DB::select('SELECT * FROM posts');
        $layoutinquiry = DB::select('SELECT * FROM inquiries');
        $layoutreport = DB::select('SELECT * FROM reports');
        $layoutrequest = DB::select('SELECT * FROM reviews');
        
        return view('admin.admin_inquiries', compact('vars', 'people', 'selected_tile', 'tiles', 'selected_person', 'selected_person_id', 'selected_from_all', 'count', 'date', 'search', 'unique', 'all','layoutpeople', 'layoutorg', 'layoutpost', 'layoutinquiry', 'layoutreport', 'layoutrequest'));
    }

    public function inquiryAdmin(Request $request){

        $sentTo = $request->input('sentTo');

        $vars = Inquiry::query()
                ->join('users', 'users.id', '=', 'inquiries.inquiryUserId')
                ->orderBy('inquiries.inquiryCreatedAt', 'DESC')
                ->get();

        foreach($vars as $v){
            if($v->inquiryStatus == "UNREAD" && $v->inquiryUserId == $sentTo){

                $updatemsg = Inquiry::find($v->inquiryId);
                $updatemsg ->  inquiryStatus = "READ";
                $updatemsg->save();
            }
            
        }

        $post2 = new AdminLog;
        $post2 ->  adminloggedBy = auth()->user()->id;
        $post2 -> adminlogUserId = $sentTo;
        $post2 -> adminlogDescription = "REPLIED";
        $post2 -> adminlogCategory = "Users Inquiries";
        $post2->save();

        

        if($request->input('inquirymessage') != ""){
            $post = new Inquiry;
            $post -> inquiryUserId = auth()->user()->id;
            $post -> inquirySentToId = $sentTo;
            $post -> inquiryMessage = $request->input('inquirymessage');
            $post->save();

            $post = new Inquiry;
            $post -> inquiryUserId = $sentTo;
            $post -> inquirySentToId = auth()->user()->id;
            $post->save();
        }
        
        return redirect()->back();
        //return view('messages.user_inquiries', compact('vars'));
    }
}
