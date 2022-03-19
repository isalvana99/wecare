<?php 
  
namespace App\Http\Controllers; 
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use App\Models\User; 
use Mail; 
use Hash;
use Illuminate\Support\Str;
  
class ForgotPasswordController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
         return view('reset.forgetPassword');
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
          ]);
  
          $token = Str::random(64);
  
          DB::table('passresets')->insert([
              'resetEmail' => $request->email, 
              'resetToken' => $token, 
              'resetCreatedAt' => Carbon::now()
            ]);
  
          Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
  
          return back()->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) { 
         //$thisemail = DB::select('SELECT * FROM passresets WHERE resetToken = '.$token['resetEmail']);
         //$thisemail = json_encode($token);
         //$thisemail = $token;
         $posts = DB::table('passresets')
              ->where('resetToken', $token)
              ->get();
        if(count($posts) > 0){
            foreach($posts as $p){
                $thisemail = $p->resetEmail;
            }
        }
        // $accemail = "";
        // if($thisemail->resetToken == $token){
        //     $accemail = $thisemail->resetEmail;
        // }
         return view('reset.forgetPasswordLink', ['token' => $token], compact('thisemail', 'posts'));//->with('accemail', $accemail);
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);
  
          $updatePassword = DB::table('passresets')
                              ->where([
                                'resetEmail' => $request->email, 
                                'resetToken' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('passresets')->where(['resetEmail'=> $request->email])->delete();
  
          return redirect('/login')->with('message', 'Your password has been changed!');
      }
}