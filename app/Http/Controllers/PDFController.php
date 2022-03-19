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
              $vars = DB::select('SELECT * FROM users WHERE orgName IS NULL AND role = "USER"');
          }else{
              $role = "USER";
              $vars = User::query()
                      ->where('role', $role)
                      ->whereNull('orgName')
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
            
          $pdf = PDF::loadView('pdf.adminUsersPDF', compact('vars', 'count'))->setPaper('long', 'landscape');
          $pdf->getDOMPdf()->set_option('isPhpEnabled', true);   
          return $pdf->stream("wecare_users_record.pdf", array("Attachment" => false));
          //return $pdf->download('samplepdf.pdf');
      }

      public function adminOrgsPDF(Request $request)
      {
        $count = 1;
        $search = $request->input('search1');
        if($search == null)
        {
            $vars = DB::select('SELECT * FROM users WHERE orgName IS NOT NULL AND role = "USER"');
        }else{
            $role = "USER";
            $vars = User::query()
                    ->where('role', $role)
                    ->whereNotNull('orgName')
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
            
          $pdf = PDF::loadView('pdf.adminOrgsPDF', compact('vars', 'count'))->setPaper('long', 'landscape');
          $pdf->getDOMPdf()->set_option('isPhpEnabled', true);   
          return $pdf->stream("wecare_organization_record.pdf", array("Attachment" => false));
          //return $pdf->download('samplepdf.pdf');
      }

      public function adminPostsPDF(Request $request)
      {
        $count = 1;

        $search = $request->input('search1');

        if($search == null)
        {
            $vars = DB::select('SELECT * FROM posts JOIN users ON users.id = posts.postUserId');
            $comments = DB::select('SELECT * FROM comments');
        }else{
            $vars = Post::query()
                    ->join('users', 'users.id', '=', 'posts.postUserId')
                    ->where(function($query) use ($search){
                        $query->where('orgName', 'LIKE', "%{$search}%")
                            ->orWhere('postId', 'LIKE', "{$search}")
                            ->orWhere('firstName', 'LIKE', "%{$search}%")
                            ->orWhere('middleName', 'LIKE', "%{$search}%")
                            ->orWhere('lastName', 'LIKE', "%{$search}%")
                            ->orWhere('postCaption', 'LIKE', "%{$search}%");
                            })
                    ->get();

            $comments = DB::select('SELECT * FROM comments');
        }
            
          $pdf = PDF::loadView('pdf.adminPostsPDF', compact('vars', 'count', 'comments'))->setPaper('long', 'landscape');
          $pdf->getDOMPdf()->set_option('isPhpEnabled', true);   
          return $pdf->stream("wecare_posts_record.pdf", array("Attachment" => false));
          //return $pdf->download('samplepdf.pdf');
      }
}
