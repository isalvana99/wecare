<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\File;
use Storage;
use DB;
class FileUploadController extends Controller
{
  public function createForm(){
    return view('file-upload');
  }

  public function fileUpload(Request $req){
        $req->validate([
        'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:102400' //max:100mb
        ]);
        $fileModel = new File;
        if($req->file()) {
            $fileName = time().'_'.$req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->fileName = time().'_'.$req->file->getClientOriginalName();
            $fileModel->filePath = '/storage/' . $filePath;
            $fileModel->fileUserId = auth()->user()->id;
            $fileModel->filePostId = $req->input('postid');
            $fileModel->save();
            return back()
            ->with('success','File has been uploaded.')
            ->with('file', $fileName);
        }
   }

   public function fileDownload(Request $request)
    {
        $filename = $request->input('filename');
        $file_path = public_path($filename);
        return response()->download($file_path);
        //return Storage::disk('public')->download('/uploads/', $filename);
    }

    public function fileDelete(Request $request)
    {
      $id = $request->input('fileid');
      DB::table('files')->where(['fileId'=> $id])->delete();
      return redirect()->back();
    }
}