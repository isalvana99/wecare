<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Models\Notif;
use DB;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails, RedirectsUsers;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        $cnt = 0;
        $notif = DB::select('SELECT * FROM notifs');
        if(count($notif) > 0){
            foreach($notif as $n){
                if($n->notifUserId == auth()->user()->id){
                    $cnt = 1;
                }
            }
        }
        
        
        if($cnt == 0){
            $post3 = new Notif;
            $post3 -> notifUserId = auth()->user()->id;
            $post3 -> notifToUserId = auth()->user()->id;
            $post3 -> notifType = "welcome";
            $post3 -> notifStatus = "UNREAD";
            $post3->save();
        }

        return $request->user()->hasVerifiedEmail()
                        ? redirect($this->redirectPath())
                        : view('verification.verify', [
                            'pageTitle' => __('Account Verification')
                        ]);
    }

    public function rememberMe()
    {   
        

        $acc = DB::select('SELECT * FROM users');
        return view('auth.login', compact('acc'));
    }
}