<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Post;
use App\Models\User;
use App\Models\Notif;
use App\Models\Recactivity;
use DB;

class TransactionController extends Controller
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
        $this -> validate($request,[
            'amountDonated' => 'required'
          ]);
  
          $pay = new Transaction;
          $pay -> transactionId = "WC".random_int(100000000000, 999999999999);
          $pay -> transactionUserId = auth()->user()->id;
          $pay -> transactionPostId = $request->input('postid');
          $pay -> transactionAction = $request->input('action');
          $pay -> transactionAmount = $request->input('amountDonated');          
          $pay -> transactionPaymentType = $request->input('paymenttype');
          $pay->save();

           $amt = $request->input('amountDonated');  
           $pi =  $request->input('postid');
        //   $post = "UPDATE posts SET amountReceived = ".$amt."WHERE posts.postId = ".$pi;

            $post = Post::find($pi);
            $post ->  postReceivedAmount = $post->postReceivedAmount + $amt;
            $post->save();

            $recepient = $request->input('recepient');  
            $donor = $request->input('donor');  

            $user1 = User::find($recepient);
            $user1 -> amountReceived = $user1->amountReceived + $amt;
            $user1 -> save();
            
            $user2 = User::find($donor);
            $user2 -> amountGiven = $user2->amountGiven + $amt;
            $user2 -> save();

            $post2 = new Notif;
            $post2 -> notifUserId = auth()->user()->id;
            $post2 -> notifToUserId = $request->input('postuserid');
            $post2 -> notifType = "donated";
            $post2 -> notifPostId = $request->input('postid');
            $post2 -> notifStatus = "UNREAD";
            $post2->save();

            $user3 = new Recactivity;
            $user3 -> recactivityBy = auth()->user()->id;
            $user3 -> recactivityUserId = $request->input('postuserid');
            $user3 -> recactivityPostId = $request->input('postid');
            $user3 -> recactivityAmount = $request->input('amountDonated');
            $user3 -> save();

            $posts = DB::select('SELECT * FROM posts JOIN users on posts.postUserId = users.id ORDER BY posts.postUpdatedAt DESC');
            $posts2 = DB::select('SELECT * FROM posts JOIN users on posts.postUserId = users.id ORDER BY posts.postUpdatedAt DESC LIMIT 10');
            $user = DB::select('SELECT * FROM users WHERE role = "USER" AND id != '.auth()->user()->id.' ORDER BY accountCreatedAt DESC LIMIT 10');
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
            $search = "";
            $search = $request->input('search');

            $previous_url = $request->input('previous_url');

            //return redirect('/home')->with('success', 'Thank you for donating!.');
            return redirect($previous_url)->with('success', 'Transaction Complete! Thank you for donating.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        // $tran = DB::select('SELECT * FROM transactions JOIN users ON users.id = transactions.transactionUserId WHERE transactions.transactionUserId = '.$id); 
        // $tran2 = DB::select('SELECT * FROM transactions JOIN posts ON posts.postId = transactions.transactionPostId WHERE transactions.transactionUserId = '.$id); 
        $tran = DB::table('transactions')
                ->join('users', 'users.id', '=', 'transactions.transactionUserId')
                ->join('posts', 'posts.postId', '=', 'transactions.transactionPostId')
                ->where('transactions.transactionUserId', '=', $id)
                ->get();
        return view('users.transactionhistory')->with('tran', $tran);
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

    public function payment1(Request $request)
    {
        $previous_url = $request->input('previous_url');
        $id = $request->input('postid');
        $amount = $request->input('amountDonated');
        $user = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.postUserId')
            ->where('posts.postId', '=', $id)
            ->get();
        $owner = DB::table('users')
            ->where('users.id', '=', auth()->user()->id)
            ->get();
        return view('payment.payment', compact('user', 'amount', 'owner', 'previous_url'));
    }

    public function payment2(Request $request)
    {
        $previous_url = $request->input('previous_url');
        $ownernum = "0".$request->input('ownernum');
        $postid = $request->input('postid');
        $amount = $request->input('amount');
        $postuserid = $request->input('postuserid');
        if($ownernum != auth()->user()->phoneNumber){
            return redirect()->back()->with('error', 'Sorry, we cannot recognize your number from our record, please try again.');
        }
        $code = random_int(100000, 999999);
        return view('payment.payment2', compact('postid', 'code', 'amount', 'postuserid', 'previous_url'));
    }
}
