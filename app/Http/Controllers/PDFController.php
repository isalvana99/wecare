<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use PDF;
use DB;
use Session;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $data = [
            'title' => 'WeCARE',
            'date' => date('m/d/Y')
        ];
          
        $pdf = PDF::loadView('pdf.myPDF', $data)->setPaper('long', 'landscape');
    
        return $pdf->download('samplepdf.pdf');
    }

    public function demoonly2(){
      
        return view('pages.homesampleonly2');
      }

      public function adminUsersPDF(Request $request)
      {
           $count = 1;
           $search = $request->input('search1');
          if($search == null)
          {
              $vars = DB::select('SELECT * FROM users WHERE orgName IS NULL AND role = "USER" ORDER BY accountCreatedAt DESC');
          }else{
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
                              ->orWhere('accountVerified', 'LIKE', "{$search}");
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
            
          $pdf = PDF::loadView('pdf.adminUsersPDF', compact('vars', 'count', 'donated', 'received'))->setPaper('long', 'landscape');
          $pdf->getDOMPdf()->set_option('isPhpEnabled', true);   
          return $pdf->stream("wecare_donors_record.pdf", array("Attachment" => false));
          //return $pdf->download('samplepdf.pdf');
      }

      public function adminOrgsPDF(Request $request)
      {
        $count = 1;
        $search = $request->input('search1');
        if($search == null)
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
                            ->orWhere('accountVerified', 'LIKE', "{$search}");
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
            
          $pdf = PDF::loadView('pdf.adminOrgsPDF', compact('vars', 'count', 'donated', 'received'))->setPaper('long', 'landscape');
          $pdf->getDOMPdf()->set_option('isPhpEnabled', true);   
          return $pdf->stream("wecare_recepients_record.pdf", array("Attachment" => false));
          //return $pdf->download('samplepdf.pdf');
      }

      public function adminPostsPDF(Request $request)
      {
        $count = 1;

        $search = $request->input('search1');

        if($search == null)
        {
            $vars = DB::select('SELECT * FROM posts JOIN users ON users.id = posts.postUserId JOIN postimages ON posts.postId = postimages.postImagePostId WHERE postUser2Id = "" ORDER BY postCreatedAt DESC');
            $comments = DB::select('SELECT * FROM comments');
        }else{
            $vars = Post::query()
                    ->join('users', 'users.id', '=', 'posts.postUserId')
                    ->join('postimages', 'posts.postId', '=', 'postimages.postImagePostId')
                    ->where('postUser2Id', '=', '')
                    ->where(function($query) use ($search){
                        $query->where('orgName', 'LIKE', "%{$search}%")
                            ->orWhere('postId', 'LIKE', "{$search}")
                            ->orWhere('firstName', 'LIKE', "%{$search}%")
                            ->orWhere('middleName', 'LIKE', "%{$search}%")
                            ->orWhere('lastName', 'LIKE', "%{$search}%")
                            ->orWhere('postCaption', 'LIKE', "%{$search}%");
                            })
                    ->orderBy('postCreatedAt', 'DESC')
                    ->get();

            $comments = DB::select('SELECT * FROM comments');
        }
            
          $pdf = PDF::loadView('pdf.adminPostsPDF', compact('vars', 'count', 'comments'))->setPaper('long', 'landscape');
          $pdf->getDOMPdf()->set_option('isPhpEnabled', true);   
          return $pdf->stream("wecare_posts_record.pdf", array("Attachment" => false));
          //return $pdf->download('samplepdf.pdf');
      }

      public function badgeCertificate(Request $request){

        $id = $request->input('badgeid');
        $vars = DB::select('SELECT * FROM badges JOIN users ON users.id = badges.badgeUserId WHERE badgeId = '.$id);

        $donated = DB::table('posts')
                ->join('transactions', 'posts.postId', '=', 'transactions.transactionPostId')
                ->join('users', 'users.id', '=', 'posts.postUserId')
                ->orderBy('transactionCreatedAt', 'DESC')
                ->get();

        //return view('pdf.badgeCertificate', compact('vars', 'donated'));

        $pdf = PDF::loadView('pdf.badgeCertificate', compact('vars', 'donated'))->setPaper('short', 'landscape');
          $pdf->getDOMPdf()->set_option('isPhpEnabled', true);   
          return $pdf->stream("wecare-certificate.pdf", array("Attachment" => false));
      }
}
