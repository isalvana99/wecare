<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../style/navstyle3.css" rel="stylesheet" type="text/css" >
    <link href="../../style/viewpost.css" rel="stylesheet" type="text/css" >
    <link href="../../style/dropdown_dots.scss" rel="stylesheet" type="text/css" >
    <link href="../../style/socialmediabuttons.css" rel="stylesheet" type="text/css" >
    <link rel="shortcut icon" href="{{ asset('images/wecarelogo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>View Post</title>
</head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #64c7fe;
  color: white;
}
</style>
<body>

    <div class="sticky-top">
     @extends('layouts.usertopnav')
    </div>

    <div class="con post_main_view">
        <div class="con1" >
            <div class="row view_post_row1">
                
                <div class="col-8w">

                    <!-- collapse view info button -->
                    <div id="editDiv{{$post->postId}}" style="display:none;">

                    <div class="col-3" style="position:absolute;margin-top:280px;margin-left:-30px;">
                    <!-- view donation history -->
                    <div class="col-12" data-toggle="modal" data-target="#donatehistpostModal2">
                        <button class="post_donate_button" style="margin-bottom:20px;">View Donation History</button>
                    </div>
                    <!-- Modal OF view donation history BUTTON-->
                    <div class="modal fade" id="donatehistpostModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    People who donated:
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body" style="">
                                    <table id="customers">
                                        <tr>
                                            <th>Date | Time</th>
                                            <th>Name</th>
                                            <th>Amount</th>
                                        </tr>
                                        @if(count($transaction) > 0)
                                        @foreach($transaction as $t)
                                        <tr>
                                            <td>{{date('Y-m-d | h:i A', strtotime($t->transactionCreatedAt))}}</td>
                                            <td>{{$t->firstName." ".$t->middleName." ".$t->lastName." ".$t->orgName}}</td>
                                            <td>PHP {{number_format($t->transactionAmount, 2)}}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2">Total</td>
                                            <td>PHP {{number_format($post->postReceivedAmount,2)}}</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td colspan="3">Empty</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>

                                <div class="modal-footer">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
                    <!-- view doation history -->

                    <!-- view transparency history -->
                    <div class="col-12" data-toggle="modal" data-target="#transparencypostModal2">
                        <button class="post_donate_button" style="margin-bottom:20px;">View Distribution</button>
                    </div>

                    <!-- Modal OF view transparency BUTTON-->
                    <div class="modal fade" id="transparencypostModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="left: -110px;width:800px;">
                                <div class="modal-header">
                                    Location: <div style="text-align:right;font-weight:bold;">&nbsp;City of {{$post->postCity}}</div>

                                    
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body" style="">
                                    @if($post->postUserId == Auth::user()->id)
                                    <form action="/show-distribution/my">
                                    <input type="hidden" name="postid" value="{{$post->postId}}">
                                    <button class="btn-delete-yes" style="display:none;">Edit</button>
                                    </form>
                                    @endif

                                    @php $total1 = 0; $total2 = 0; @endphp
                                    @if(count($transparency) > 0)
                                    @foreach($transparency as $i=>$tran)
                                        @php $total1 += $tran->transparencyAmount; @endphp
                                        @php $total2 += $tran->transparencyAmount; @endphp
                                    @endforeach
                                    @endif
                                    <div style="text-align:right;font-weight:bold;display:flex;float:right;">
                                    (Grand Total) Donations: PHP {{number_format($post->postReceivedAmount,2)}} |  Distributions: PHP {{number_format($total1,2)}} | Remaining: PHP @php $remains = $post->postReceivedAmount - $total1; @endphp @if($remains < 0) <div style="color:red;">&nbsp;{{number_format($remains,2)}}</div> @else {{number_format($remains,2)}} @endif
                                    </div><br>

                                    

                                    <!-- update / delete record -->
                                    <div class="row">
                                    <div class="col-12">
                                    <table>
                                        <tr style="border-top:1px solid black;">
                                            <th>Barangay</th>
                                            <th>Date</th>
                                            <!-- <th>Person-in-Charge</th> -->
                                            <th>Name/Recepient</th>
                                            <th>Amount</th>
                                        </tr>

                                        @if(count($transparency) > 0)
                                        @foreach($transparency as $i=>$tran)
                                        <tr>
                                            
                                            <input type="hidden" name="menusettings[{{$i}}][transparencyid]" id="" value="{{$tran->transparencyId}}">
                                            <input type="hidden" name="menusettings[{{$i}}][postid]" id="" value="{{$post->postId}}">

                                            <td style="background:white;">{{$tran->transparencyLocation}}</td>
                                            <td style="background:white;">{{date('F j, Y',strtotime($tran->transparencyCreatedAt))}}</td>
                                            <!-- <td>{{$tran->firstName}}</td> -->
                                            <td style="background:white;">{{$tran->firstName.' '.$tran->middleName.' '.$tran->lastName.' '.$tran->orgName}}</td>
                                            <td style="background:white;">PHP {{number_format($tran->transparencyAmount,2)}}</td>
                                            
                                        </tr>
                                        @endforeach
                                        
                                        <tr style="border-top:1px solid black;">
                                        
                                            <td  colspan="3">Total</td>
                                            <td>PHP {{number_format($total2,2)}}</td>
                                        </tr>
                                        @endif

                                    </table>
                                    </div>
                                    <!-- update / delete record end -->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
                    <!-- view transparency history -->

                    <!-- view add files history -->
                    <div class="col-12" data-toggle="modal" data-target="#addfilepostModal2">
                        <button class="post_donate_button" style="margin-bottom:20px;">View Attached Files</button>
                    </div>
                    <!-- Modal OF view donation history BUTTON-->
                    <div class="modal fade" id="addfilepostModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="width:705px;">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body" style="width:700px;display:none;">
                                    <div class="container">
                                    @if($post->postUserId == Auth::user()->id)
                                        <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="postid" value="{{$post->postId}}">
                                            @csrf
                                            @if ($message = Session::get('success'))
                                            <div class="alert alert-success">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @endif
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                            <label for="formFileMultiple" class="form-label">Upload File Here</label>
                                            <input class="form-control" type="file" id="formFileMultiple" name="file"/>
                                            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                                                Upload Files
                                            </button>

                                        </form>
                                    @endif
                                </div>
                                </div>

                                
                                    <table id="customers" style="width:700px;">
                                        <tr>
                                            <th>Date | Time</th>
                                            <th>Click the file to download</th>
                                            <th>Uploaded by:</th>
                                        </tr>
                                        @if(count($files) > 0)
                                        @foreach($files as $file)
                                        <tr>
                                            <td style="width:230px;">{{date('F j, Y | h:i A', strtotime($file->fileCreatedAt))}}
                                            </td>
                                            <td>
                                                <form action="{{route('fileDownload')}}" method="GET">
                                                    <input type="hidden" name="filename" id="" value="{{$file->filePath}}">
                                                    <button type="submit" style="background:none;border:none;width:300px;">{{$file->fileName}}</button>
                                                </form>
                                            </td>
                                            <td style="width:200px;">
                                                {{$file->firstName." ".$file->middleName." ".$file->lastName." ".$file->orgName}}
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="3">No File</td>
                                        </tr>
                                        @endif
                                    </table>
                                

                                <div class="modal-footer">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
                    <!-- view add files history -->

                    </div>
                    </div>
                    <!-- collapse view info button end-->

                    <div class="row view_post_left_row">
                        <div style="margin-top:5px;width:930px;opacity: 0.9;">@include('inc.messages')
                        <button onclick="document.getElementById('editDiv{{$post->postId}}').style.display == 'none' ? document.getElementById('editDiv{{$post->postId}}').style.display = 'inline' : document.getElementById('editDiv{{$post->postId}}').style.display = 'none'" style="background:none;border:1px solid #00d9ff;color:#00d9ff;font-size:30px;border-radius:10px;margin:5px;position:absolute;top:520px;"><i class="fa fa-info-circle" aria-hidden="true"></i></button>
                        </div>
                        <img src="/storage/cover_images/{{$post->postImageName}}" alt="" class="view_post_img">
                    </div>
                </div>
                <div class="w-100 seperator"></div>
                <div class="col-4w">
                    <div class="row view_post_right_row">
                    
        	            <div class="con">
                            <div class="row">
                                <div class="col-2" style="margin-left:10px;">
                                    <div class="row"  style="margin-top: 10px;">
                                        @if($post->id == Auth::user()->id)
                                        <img src="/storage/profile_images/{{$post->profileImage}}" class="view_right_user_pic2" alt="">
                                        @else
                                        <img src="/storage/profile_images/{{$post->profileImage}}" class="view_right_user_pic" alt="">
                                        @endif
                                    </div>
                                    <div class="row view-follow-row">
                                    @php $count = 0 @endphp
                                        @if(count($follows) > 0)
                                        @foreach($follows as $follow)
                                            @if($follow->followedUserId == $post->id)
                                                @if($follow->followUserId == Auth::user()->id)

                                                    @php $count = 1 @endphp

                                                @endif
                                                
                                            @endif
                                        @endforeach
                                        @endif

                                        @if($post->postUserId != Auth::user()->id)
                                        @if($count == 1)
                                        {!!Form::open(['action' => ['App\Http\Controllers\FollowController@destroy', $follow->followId], 'method' => 'POST', 'id' => 'followform'])!!}
                                            <input type="hidden" name="followpostid" value="{{$post->postId}}">

                                            <button type="submit" class="follow-btn">
                                                <i class="fal fa-user-check following-icon"> Following</i>
                                            </button>
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {!!Form::close()!!}

                                        @else
                                        {!! Form::open(['action' => 'App\Http\Controllers\FollowController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                                            <input type="hidden" name="followpostid" value="{{$post->postId}}">
                                            
                                            <button type="submit" class="follow-btn">
                                            <i class="fal fa-user-plus follow-icon" > Follow</i>
                                            </button>
                                        {!! Form::close() !!}
                                        @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="col-8 view_post_col_user">
                                    <div class="row">
                                        <div style="width:auto;">
                                        <a href="/users/profile/{{$post->postUserId}}" class="view_post_user_name">{{$post->firstName." ".$post->middleName." ".$post->lastName." ".$post->orgName}}</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <a href="" class="view_post_i">
                                            <i class="fal fa-map-marker-alt"></i>
                                            {{$post->postSector.", ".$post->postBarangay.", ".$post->postCity.", ".$post->province.", ".$post->postRegion}}
                                        </a>
                                    </div>
                                    <div class="row">
                                        <a href="" class="view_post_i">
                                        </a>
                                    </div>
                                    <div class="row">
                                        <a href="" class="view_post_i">
                                            <i class="fal fa-clock"></i>
                                            @php
                                            // $today = date("Y-m-d h:i:s");
                                            // $start_date = new DateTime($today);
                                            // $since_start = $start_date->diff(new DateTime($post->postCreatedAt));
                                            // Declare and define two dates
                                            date_default_timezone_set("Asia/Manila");
                                            $today = date("Y-m-d H:i:s");
                                            $date1 = strtotime(date("Y-m-d H:i:s"));
                                            $date2 = strtotime($post->postCreatedAt);
                                            
                                            // Formulate the Difference between two dates
                                            $diff = abs($date2 - $date1);
                                            
                                            // To get the year divide the resultant date into
                                            // total seconds in a year (365*60*60*24)
                                            $years = floor($diff / (365*60*60*24));
                                            
                                            // To get the month, subtract it with years and
                                            // divide the resultant date into
                                            // total seconds in a month (30*60*60*24)
                                            $months = floor(($diff - $years * 365*60*60*24)
                                                                            / (30*60*60*24));
                                            
                                            // To get the day, subtract it with years and
                                            // months and divide the resultant date into
                                            // total seconds in a days (60*60*24)
                                            $days = floor(($diff - $years * 365*60*60*24 -
                                                        $months*30*60*60*24)/ (60*60*24));
                                            
                                            // To get the hour, subtract it with years,
                                            // months & seconds and divide the resultant
                                            // date into total seconds in a hours (60*60)
                                            $hours = floor(($diff - $years * 365*60*60*24
                                                    - $months*30*60*60*24 - $days*60*60*24)
                                                                                / (60*60));
                                            
                                            // To get the minutes, subtract it with years,
                                            // months, seconds and hours and divide the
                                            // resultant date into total seconds i.e. 60
                                            $minutes = floor(($diff - $years * 365*60*60*24
                                                    - $months*30*60*60*24 - $days*60*60*24
                                                                        - $hours*60*60)/ 60);
                                            
                                            // To get the minutes, subtract it with years,
                                            // months, seconds, hours and minutes
                                            $seconds = floor(($diff - $years * 365*60*60*24
                                                    - $months*30*60*60*24 - $days*60*60*24
                                                            - $hours*60*60 - $minutes*60));
                                            
                                            // Print the result
                                            if($days == 0 && $months == 0 && $years == 0){
                                                if($hours == 0){
                                                    if($minutes == 0){
                                                        if($seconds == 1){
                                                            echo $seconds." second ago";
                                                        }else{
                                                            echo $seconds." seconds ago";
                                                        }
                                                    }else if($minutes == 1){
                                                        echo $minutes." minute ago";
                                                    }else{
                                                        echo $minutes." minutes ago";
                                                    }
                                                }else if($hours == 1){
                                                    echo $hours." hour ago";
                                                }else{
                                                    echo $hours." hours ago";
                                                }
                                            }else if($days == 1 && $months == 0 && $years == 0){
                                                echo $days." day ago";
                                            }else if($days < 7 && $days > 0 && $months == 0 && $years == 0){
                                                echo $days." days ago";
                                            }else{
                                                echo date('F j, Y', strtotime($post->postCreatedAt));
                                            }

                                            @endphp
                                        </a>
                                    </div>
                                </div>
                                <!-- 3 dots -->
                                <div class="col-1">
                                <div class="three-dots-small">
                                <div class="dropdown dots">

                                    <button class="btn tdots" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter2">
                                        <i class="fal fa-ellipsis-v fa-2x"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    @if(Auth::user()->id != $post->postUserId)
                                                    <!-- post report -->
                                                    <button class="btn btn2" style="width:100%;text-align:left;" type="button" onclick="reportFunction()">Report Post</button>
                                                    <form action="{{route('report')}}" method="GET">
                                                    <input type="hidden" name="userid" value="">
                                                    <input type="hidden" name="postid" value="{{$post->postId}}">
                                                    <input type="hidden" name="commentid" value="">
                                                    <div class="row" id="reportDiv" style="display:none;">
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="reportDescription" id="exampleRadios1-{{$post->postId}}" value="Inappropriate" onclick="document.getElementById('custom-{{$post->postId}}').disabled = true">
                                                                <label class="form-check-label" for="exampleRadios1-{{$post->postId}}">
                                                                Inappropriate
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="reportDescription" id="exampleRadios2-{{$post->postId}}" value="Scam" onclick="document.getElementById('custom-{{$post->postId}}').disabled = true">
                                                                <label class="form-check-label" for="exampleRadios2-{{$post->postId}}">
                                                                Scam
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="reportDescription" id="exampleRadios3-{{$post->postId}}" value="False Information" onclick="document.getElementById('custom-{{$post->postId}}').disabled = true">
                                                                <label class="form-check-label" for="exampleRadios3-{{$post->postId}}">
                                                                False Information
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="reportDescription" id="exampleRadios4-{{$post->postId}}" value="Vulgar" onclick="document.getElementById('custom-{{$post->postId}}').disabled = true">
                                                                <label class="form-check-label" for="exampleRadios4-{{$post->postId}}">
                                                                Vulgar
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="reportDescription" id="exampleRadios6-{{$post->postId}}" value="Vulgar" onclick="document.getElementById('custom-{{$post->postId}}').disabled = false">
                                                                <label class="form-check-label" for="exampleRadios6-{{$post->postId}}" style="width:400px;">
                                                                Other: <small>(Please tell us, so we can understand.)</small> 
                                                                </label>
                                                                <textarea type="text" name="reportDescription" id="custom-{{$post->postId}}" placeholder="" style="width:400px;height:100px;" required disabled></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="">
                                                                <button type="submit" class="btn-delete-yes"  style="position:relative;width:100%;">Send Report</button>
                                                                <button class="btn-delete-no" type="button" class="close" data-dismiss="modal" aria-label="Close" style="position:absolute;margin-left:110px;width:50%;">Cancel</button>
                                                            </div>
                                                        </div>
                                                            
                                                    </div>
                                                    </form>
                                                    <!-- /post report -->
                                                    @endif

                                                    @if(Auth::user()->id == $post->postUserId)
                                                    <!-- post edit -->
                                                    <button class="btn btn2" style="width:100%;text-align:left;" type="button" onclick="editFunction()">Edit Post</button>
                                                    <div class="row deleteDiv2" id="editDiv" style="display:none; ">
                                                        <div class="row">
                                                        {!! Form::open(['action' => ['App\Http\Controllers\PostsController@update', $post->postId], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            
                                                            <div class="form-group" style="margin-top:20px;">
                                                            <label for="edit_post" style="background:#dbdcdd;padding:10px 10px 10px 20px;border-radius:5px;width:100%;">You may edit your title:</label>
                                                            <input class="form-control" type="text" name="title" value="{{$post->postCategory}}">
                                                            <label for="edit_post" style="background:#dbdcdd;padding:10px 10px 10px 20px;border-radius:5px;width:100%;margin-top:5px;">You may edit your caption:</label>
                                                            {{Form::textarea('caption', $post->postCaption, ['class' => 'form-control'])}}
                                                            </div>
                                                            <div class="" style="position:absolute;width:50%;margin-left:290px;">
                                                                <div class="">
                                                                    <button class="btn-delete-no" type="button" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
                                                                </div>
                                                            </div>  
                                                        {{Form::hidden('_method', 'PUT')}}
                                                        {{Form::submit('Update Changes', ['class' => 'btn-delete-yes'])}}
                                                        {!! Form::close() !!}
                                                        
                                                        </div>
                                                        
                                                    </div>
                                                    <!--/post edit -->

                                                    <!--post delete -->
                                                    <button class="btn btn2" style="width:100%;text-align:left;" type="button" onclick="deleteFunction()">Delete Post</button>
                                                    <div class="row deleteDiv2" id="deleteDiv" style="display:none; ">
                                                    <br>
                                                        <div class="row" style="margin-top:20px;">
                                                            <div class="col" style="background:#dbdcdd;padding:20px;border-radius:10px;">
                                                                Are you sure you want to delete this post? Please note that you cannot undo this after.
                                                            </div>
                                                        </div>

                                                        <div class="row" style="display:flex;">
                                                            {!!Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->postId], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                                            <div class="" style="position:relative;width:50%;margin-left:50px;">
                                                                <div class="">
                                                                    <button type="submit" class="btn-delete-yes">Yes, delete</button>
                                                                </div>
                                                            </div>  
                                                            {{Form::hidden('_method', 'DELETE')}}
                                                            {!!Form::close()!!}
                                                            <div class="" style="position:absolute;width:50%;margin-left:250px;">
                                                                <div class="">
                                                                    <button class="btn-delete-no" type="button" class="close" data-dismiss="modal" aria-label="Close">No</button>
                                                                </div>
                                                            </div>                                     
                                                        </div>
                                                    </div>
                                                    <!-- /post delete -->
                                                    @endif

                                                    @if($post->postStatus == "BANNED")
                                                    <div><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size:14px"></i> This post is banned, no further action is required.</div>
                                                    @endif

                                                    @if($post->postStatus == "VERIFIED" && Auth::user()->id == $post->postUserId)
                                                    <div><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size:14px"></i> This post is verified, changes are not allowed.</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                </div>
                                <!-- /3 dots -->
                            </div>
                            
                            <div class="row post_caption_con">
                            <h4 style="text-decoration:underline;">{{$post->postCategory}}</h4>
                            <p style="">{{$post->postCaption}}</p>
                            </div>

                            <!-- fourth row (donation area) -->
                            <div class="row post_donation_con">
                                <div class="col-4">
                                @if(Auth::user()->id == $post->postUserId || Auth::user()->accountType == "DONOR")

                                    @if(Auth::user()->id != $post->postUserId && $post->postStatus != "BANNED" && $post->postStatus != "STOPPED")
                                    <div data-toggle="modal" data-target="#mpostModal2-{{$post->postId}}">
                                        <input type="hidden" name="postid" value="{{$post->postId}}">
                                        <button class="post_donate_button">Donate</button>
                                    </div>
                                    @elseif($post->postStatus == "BANNED")
                                    <button class="post_donate_button_disabled" style="background-color:#90A4AE;cursor: no-drop;color:white;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Post Banned</button>
                                    @elseif(Auth::user()->id == $post->postUserId && $post->postStatus != "BANNED" && $post->postStatus != "STOPPED")
                                    <form action="{{route('stopdonation')}}" method="GET">
                                    <div>
                                        <input type="hidden" name="postid" value="{{$post->postId}}">
                                        <button class="post_donate_button" style="font-size:11px;">Stop Accepting Donation</button>
                                    </div>
                                    </form>
                                    @elseif(Auth::user()->id == $post->postUserId && $post->postStatus == "STOPPED")
                                    <form action="{{route('godonation')}}" method="GET">
                                        <div>
                                            <input type="hidden" name="postid" value="{{$post->postId}}">
                                            <button class="post_donate_button" style="background-color:#565bbb;">Undo Stop</button>
                                        </div>
                                    </form>
                                    @elseif(Auth::user()->id != $post->postUserId && $post->postStatus == "STOPPED")
                                    <div>
                                        <button class="post_donate_button_disabled">Donate Unavailable</button>
                                    </div>

                                    @endif

                                @elseif(Auth::user()->id != $post->postUserId && Auth::user()->accountType == "RECEPIENT")
                                <div>
                                    <button class="post_donate_button_disabled">View Post</button>
                                </div>

                                @endif
                                    
                                    <!--  <button class="post_donate_button_disabled">Donate</button> THIS IS DISABLED BUTTON -->

                                    <!-- Modal OF DONATE BUTTON-->
                                    <div class="modal fade" id="mpostModal2-{{$post->postId}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="height:300px;">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Please help {{$post->firstName." ".$post->orgName}} by donating, thank you!</h5>
                                                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                                                    <i class="fal fa-times" aria-hidden="true" class="close-btn"></i>
                                                    </button>
                                                </div>

                                                <div class="modal-body" style="height:100px;">
                                                    <form action="/payment/" method="GET">
                                                    <div class="form-group">
                                                    <label for="amount" style="font-weight:bold;font-size:18px;">Enter Amount:</label><br>
                                                    PHP <input style="border-radius: 10px;padding:5px;" type="number" name="hamount" onkeypress="return isNumber(event)">
                                                    </div>
                                                    <input type="hidden" name="postid" value="{{$post->postId}}">
                                                    <input type="hidden" name="postuserid" value="{{$post->postUserId}}">
                                                    <input type="hidden" name="action" value="DONATE">
                                                    <input type="hidden" name="paymenttype" value="GCASH">
                                                    <input type="hidden" name="recepient" value="{{$post->postUserId}}">
                                                    <input type="hidden" name="donor" value="{{Auth::user()->id}}">
                                                    <input type="hidden" name="previous_url" value="/home/{{$post->postId}}">
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" style="width:100%;">Proceed to Payment</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /END Modal -->
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <label for="" class=" post_amount_need">PHP {{number_format($post->postReceivedAmount, 2)}} / PHP {{number_format($post->postTargetAmount, 2)}}</label>
                                    </div>
                                    <div class="row">
                                        
                                    @if($post->postReceivedAmount > 0)
                                    @php $val = ($post->postReceivedAmount/$post->postTargetAmount)*100 @endphp
                                    <div class="progress2 progress-moved">
                                        @if( $val >= 100)
                                            <div class="progress-bar2" style="width:100%;" ></div>
                                        @endif
                                        @if( $val >= 90 AND $val < 100)
                                            <div class="progress-bar2" style="width:90%;" ></div>
                                        @endif
                                        @if( $val >= 80 AND $val < 90)
                                            <div class="progress-bar2" style="width:80%;" ></div>
                                        @endif
                                        @if( $val >= 70 AND $val < 80)
                                            <div class="progress-bar2" style="width:70%;" ></div>
                                        @endif
                                        @if( $val >= 60 AND $val < 70)
                                            <div class="progress-bar2" style="width:60%;" ></div>
                                        @endif
                                        @if( $val >= 50 AND $val < 60)
                                            <div class="progress-bar2" style="width:50%;" ></div>
                                        @endif
                                        @if( $val >= 40 AND $val < 50)
                                            <div class="progress-bar2" style="width:40%;" ></div>
                                        @endif
                                        @if( $val >= 30 AND $val < 40)
                                            <div class="progress-bar2" style="width:30%;" ></div>
                                        @endif
                                        @if( $val >= 20 AND $val < 30)
                                            <div class="progress-bar2" style="width:20%;" ></div>
                                        @endif
                                        @if( $val >= 10 AND $val < 20)
                                            <div class="progress-bar2" style="width:10%;" ></div>
                                        @endif
                                        @if( $val >= 1 AND $val < 10)
                                            <div class="progress-bar2" style="width:5%;" ></div>
                                        @endif
                                    </div>
                                    @elseif( $post->postTargetAmount == 0)
                                    <div class="progress2 progress-moved">
                                        <div class="progress-bar2" style="width:100%;" ></div>
                                    </div> 
                                    @else
                                    <div class="progress2 progress-moved">
                                        <div class="progress-bar2" style="width:0%;" ></div>
                                    </div> 
                                    @endif             
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- fourth row end -->

                            <hr>

                            <div class="row react_button_row">
                                <!-- like -->
                                <div class="col-4 button_react_con">
                                @php $count = 0; $likeid =0; @endphp

                                @if(count($likes2) > 0)
                                @foreach($likes2 as $like)
                                    @if($like->likePostId == $post->postId)
                                        @if($like->likeUserId == Auth::user()->id)

                                            @php $count = 1; $likeid = $like->likeId; @endphp

                                        @endif
                                        
                                    @endif
                                @endforeach
                                @endif

                                @if($count == 1)
                                {!!Form::open(['action' => ['App\Http\Controllers\LikeController@destroy', $likeid], 'method' => 'POST'])!!}
                                <input type="hidden" name="likepostid" value="{{$post->postId}}">

                                <button class="react_btn_active">
                                    <img src="../../images/wecare svg.svg" class="wecarelogo_svg" alt="">
                                    <a href="">{{$post->postLikes}}</a>
                                </button>

                                {{Form::hidden('_method', 'DELETE')}}
                                {!!Form::close()!!}

                                @else

                                {!! Form::open(['action' => 'App\Http\Controllers\LikeController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                <input type="hidden" name="likepostid" value="{{$post->postId}}">
                                <input type="hidden" name="likeuserid" value="{{$post->postUserId}}">
                                <button class="react_btn_style">
                                    <img src="../../images/wecare svg.svg" class="wecarelogo_svg" alt="">
                                    <a href="">{{$post->postLikes}}</a>
                                </button>
                                
                                {!! Form::close() !!}
                                @endif
                                </div>
                                <!-- /like -->

                                <!-- comment -->
                                <div class="col-4 button_react_con">
                                    @if(count($comment) >= 0)
                                    @php $com = 0 @endphp
                                    @foreach($comment as $c)
                                        @if($post->postId == $c->commentPostId)
                                            @php $com++ @endphp
                                        @endif
                                    @endforeach
                                    <button class="react_btn_style">
                                        <i class="fas fa-comment-alt"></i>
                                        <a href="">{{$com}}</a>
                                    </button>
                                    @endif
                                </div>
                                <!-- /comment -->

                                <!-- share -->
                                <div class="col-4 button_react_con" data-toggle="modal" data-target="#epostModal3-{{$post->postId}}">
                                    <button class="react_btn_style">
                                        <i class="fas fa-share"></i>
                                        <a href="">Share</a>
                                    </button>
                                </div>
                                <!-- Modal OF SHARE BUTTON-->
                                <div class="modal fade" id="epostModal3-{{$post->postId}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Share this post to:</h5>
                                                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                                                <i class="fal fa-times" aria-hidden="true" class="close-btn"></i>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                {!! Share::page(url('/home/'. $post->postId))->facebook()->twitter()->whatsapp() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /END Modal -->
                                <!-- /share -->
                            </div>

                            <hr>

                            <div class="row view_post_comment_con">
                                <div class="container">

                                    <div class="row row_comment_con">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="/storage/profile_images/{{Auth::user()->profileImage}}" class="view_commentor_pic" alt="">
                                            </div>
                                            <div class="col-10 view_add_comment">
                                                
                                                <button data-toggle="modal" data-target="#exampleModalCenter">
                                                    Add comment
                                                </button>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <!-- comment container -->
                                    @if(count($postreaction)>0)
                                    @foreach($postreaction as $pr)
                                    <div class="row row_comment_con">
                                        <div class="row">
                                            <div class="col-3">
                                                <img src="/storage/profile_images/{{$pr->profileImage}}" class="view_commentor_pic" alt="">
                                            </div>
                                            <div class="col-8 commentor_details">
                                                <div class="row view_commentor_name">
                                                {{$pr->firstName." ".$pr->middleName." ".$pr->lastName." ".$pr->orgName}}
                                                </div>
                                                <div class="row view_commentor_time">
                                                @php
                                                // $today = date("Y-m-d h:i:s");
                                                // $start_date = new DateTime($today);
                                                // $since_start = $start_date->diff(new DateTime($pr->commentCreatedAt));
                                                // Declare and define two dates
                                                date_default_timezone_set("Asia/Manila");
                                                $today = date("Y-m-d H:i:s");
                                                $date1 = strtotime(date("Y-m-d H:i:s"));
                                                $date2 = strtotime($pr->commentCreatedAt);
                                                
                                                // Formulate the Difference between two dates
                                                $diff = abs($date2 - $date1);
                                                
                                                // To get the year divide the resultant date into
                                                // total seconds in a year (365*60*60*24)
                                                $years = floor($diff / (365*60*60*24));
                                                
                                                // To get the month, subtract it with years and
                                                // divide the resultant date into
                                                // total seconds in a month (30*60*60*24)
                                                $months = floor(($diff - $years * 365*60*60*24)
                                                                                / (30*60*60*24));
                                                
                                                // To get the day, subtract it with years and
                                                // months and divide the resultant date into
                                                // total seconds in a days (60*60*24)
                                                $days = floor(($diff - $years * 365*60*60*24 -
                                                            $months*30*60*60*24)/ (60*60*24));
                                                
                                                // To get the hour, subtract it with years,
                                                // months & seconds and divide the resultant
                                                // date into total seconds in a hours (60*60)
                                                $hours = floor(($diff - $years * 365*60*60*24
                                                        - $months*30*60*60*24 - $days*60*60*24)
                                                                                    / (60*60));
                                                
                                                // To get the minutes, subtract it with years,
                                                // months, seconds and hours and divide the
                                                // resultant date into total seconds i.e. 60
                                                $minutes = floor(($diff - $years * 365*60*60*24
                                                        - $months*30*60*60*24 - $days*60*60*24
                                                                            - $hours*60*60)/ 60);
                                                
                                                // To get the minutes, subtract it with years,
                                                // months, seconds, hours and minutes
                                                $seconds = floor(($diff - $years * 365*60*60*24
                                                        - $months*30*60*60*24 - $days*60*60*24
                                                                - $hours*60*60 - $minutes*60));
                                                
                                                // Print the result
                                                if($days == 0 && $months == 0 && $years == 0){
                                                    if($hours == 0){
                                                        if($minutes == 0){
                                                            if($seconds == 1){
                                                                echo $seconds." second ago";
                                                            }else{
                                                                echo $seconds." seconds ago";
                                                            }
                                                        }else if($minutes == 1){
                                                            echo $minutes." minute ago";
                                                        }else{
                                                            echo $minutes." minutes ago";
                                                        }
                                                    }else if($hours == 1){
                                                        echo $hours." hour ago";
                                                    }else{
                                                        echo $hours." hours ago";
                                                    }
                                                }else if($days == 1 && $months == 0 && $years == 0){
                                                    echo $days." day ago";
                                                }else if($days < 7 && $days > 0 && $months == 0 && $years == 0){
                                                    echo $days." days ago";
                                                }else{
                                                    echo date('F j, Y', strtotime($pr->commentCreatedAt));
                                                }

                                                @endphp
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-12 view_commentor_caption">
                                        {{$pr->commentDescription}} 
                                        </div>

                                        @if($pr->commentUserId == Auth::user()->id)
                                            <div class="comment-btn-auth" data-toggle="modal" data-target="#postModal-{{$pr->commentId}}" style="">Edit Comment</div>  

                                            <div class="comment-btn-auth" data-toggle="modal" data-target=".bd-delete-modal-sm-{{$pr->commentId}}" style="">Delete</div>
                                        @else
                                            <div class="comment-btn-auth" data-toggle="modal" data-target="#editModal-{{$pr->commentId}}" style="">Report Comment</div>
                                        @endif

                                        
                                        
                                            <!-- edit modal -->
                                            <div class="modal fade" id="postModal-{{$pr->commentId}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                
                                                </div>

                                                <div class="modal-body">
                                                {!! Form::open(['action' => ['App\Http\Controllers\CommentController@update', $pr->commentId], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                                    <input type="hidden" value="{{$pr->commentPostId}}" name="post_id">
                                                    <div class="form-group">
                                                    <label for="edit_post">Edit Your Comment</label>
                                                    {{Form::textarea('description', $pr->commentDescription, ['class' => 'form-control'])}}
                                                    </div>

                                                {{Form::hidden('_method', 'PUT')}}
                                                {{Form::submit('Done', ['class' => 'btn btn-primary'])}}
                                                {!! Form::close() !!}

                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            <!-- /edit comment modal -->

                                            
                                            <!-- delete modal -->
                                            {!!Form::open(['action' => ['App\Http\Controllers\CommentController@destroy', $pr->commentId], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                                <input type="hidden" value="{{$pr->commentPostId}}" name="post_id">
                                                <input type="hidden" name="current_description" value="{{$pr->commentDescription}}">
                                            <div class="modal fade bd-delete-modal-sm-{{$pr->commentId}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                        Are you sure you want to delete your comment? Please note that you cannot undo this after.
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary primary_btn">Yes</button>
                                                            <button type="button" class="btn btn-secondary second_btn" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {!!Form::close()!!}
                                            <!-- end of delete modal -->

                                            <!-- report modal -->
                                            <div class="modal fade" id="editModal-{{$pr->commentId}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                
                                                </div>

                                                <div class="modal-body">
                                                <form action="{{route('report')}}" method="GET">
                                                <input type="hidden" name="userid" value="">
                                                <input type="hidden" name="postid" value="">
                                                <input type="hidden" name="commentid" value="{{$pr->commentId}}">
                                                <div class="row" id="reportDiv" style="display:block;">
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="reportDescription" id="exampleRadios1-{{$pr->commentId}}" value="Inappropriate" onclick="document.getElementById('custom-{{$pr->commentId}}').disabled = true">
                                                            <label class="form-check-label" for="exampleRadios1-{{$pr->commentId}}">
                                                            Inappropriate
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="reportDescription" id="exampleRadios2-{{$pr->commentId}}" value="Scam" onclick="document.getElementById('custom-{{$pr->commentId}}').disabled = true">
                                                            <label class="form-check-label" for="exampleRadios2-{{$pr->commentId}}">
                                                            Scam
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="reportDescription" id="exampleRadios3-{{$pr->commentId}}" value="False Information" onclick="document.getElementById('custom-{{$pr->commentId}}').disabled = true">
                                                            <label class="form-check-label" for="exampleRadios3-{{$pr->commentId}}">
                                                            False Information
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="reportDescription" id="exampleRadios4-{{$pr->commentId}}" value="Vulgar" onclick="document.getElementById('custom-{{$pr->commentId}}').disabled = true">
                                                            <label class="form-check-label" for="exampleRadios4-{{$pr->commentId}}">
                                                            Vulgar
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="reportDescription" id="exampleRadios6-{{$pr->commentId}}" value="Vulgar" onclick="document.getElementById('custom-{{$pr->commentId}}').disabled = false">
                                                            <label class="form-check-label" for="exampleRadios6-{{$pr->commentId}}" style="width:400px;">
                                                            Other: <small>(Please tell us, so we can understand.)</small> 
                                                            </label>
                                                            <textarea type="text" name="reportDescription" id="custom-{{$pr->commentId}}" placeholder="" style="width:400px;height:100px;" required disabled></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <button type="submit" class="btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>

                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            <!-- /edit comment modal -->
                                    </div>
                                    @endforeach
                                    @endif
                                    <!-- comment end -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <!-- add comment Modal -->
    {!! Form::open(['action' => 'App\Http\Controllers\CommentController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <input type="hidden" name="post_id_temp" value="{{$post->postId}}">
        <input type="hidden" name="likeuserid" value="{{$post->postUserId}}">
                                                
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Type your comment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <textarea class="add_comment_modal" name="comment" id="" cols="58" rows="7" placeholder="Type your comments here.."></textarea>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary primary_btn">Comment</button>
            <button type="button" class="btn btn-secondary second_btn" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    {!! Form::close() !!}
    <!-- add comment modal end -->


    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!--/jquery-->

    <!--Javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <!--/script-->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- custom scrollbar plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <Script>
        function myFunction() {
        var x = document.getElementById("dot-con");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
        }
    </Script>

<script>
function reportFunction() {
  var x = document.getElementById("reportDiv");
  if (x.style.display === "none") {
    x.style.display = "inline";
  } else {
    x.style.display = "none";
  }
}
</script>

<script>
function editFunction() {
  var x = document.getElementById("editDiv");
  var y = document.getElementById("deleteDiv");
  if (x.style.display === "none") {
    x.style.display = "inline";
    y.style.display = "none";
  } else {
    x.style.display = "none";
  }
}
</script>

<script>
function deleteFunction() {
  var x = document.getElementById("deleteDiv");
  var y = document.getElementById("editDiv");
  if (x.style.display === "none") {
    x.style.display = "inline";
    y.style.display = "none";
  }else {
    x.style.display = "none";
  }
}
</script>

<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
</body>
</html>