@extends('layouts.user_layout')

@section('content')
<link href="../../style/poststyles3.css" rel="stylesheet" type="text/css" >

<!-- body container here -->

<!-- left area  -->
<div class="col-3 left_area_con">
    <div class="container left_inner_con" style="" >
        <!-- start of first row (user profile) -->
        <div class="row left_header_con">
            <!-- start of grey container -->
            <div class="col left_head_inner" >
                <div class="row pic_col">
                    <div class="col-3">
                        <img src="/storage/profile_images/{{Auth::user()->profileImage}}" class="left_user_pic" alt="">
                    </div>
                    <div class="col-8">
                        <div class="row left_user_name1">
                        {{Auth::user()->firstName." ".Auth::user()->middleName." ".Auth::user()->lastName." ".Auth::user()->orgName}}
                        </div>
                        <div class="row left_edit_pro">
                            <a href="/users/{{Auth::user()->id}}/edit">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of grey container -->
        </div>
        <!-- end of user profile -->

        <!-- amount received container -->
        @if(Auth::user()->accountType == "RECEPIENT")
        <div class="row amount_con">
            <div class="col">
                <div class="row left_received">
                    Total Amount Received:
                </div>
                <div class="row left_amount">
                    <label for="">PHP {{number_format(Auth::user()->amountReceived, 2)}}</label>
                </div>
            </div>
        </div>
        <!-- end amount received container -->
        @endif
        @if(Auth::user()->accountType == "DONOR")
        <!-- amount Donated container -->
        <div class="row amount_con">
            <div class="col">
                <div class="row left_received">
                   Total Amount Donated:
                </div>
                <div class="row left_amount">
                    <label for="">PHP {{number_format(Auth::user()->amountGiven, 2)}}</label>
                </div>
            </div>
        </div>
        <!-- end amount donated container -->
        @endif

        <div class="row buttons_area">
            <!-- button selected design -->
            <div class="col left_btn_con1 selected_btn_style">
                <div class="row">
                    <a href="/home"><i class="fas fa-th-large"></i>Feed</a>
                </div>
            </div>
            <!-- end of selected design -->

            <div class="w-100"></div> <!-- use this to seperate each button -->

            <!-- normal button design -->
            <div class="col left_btn_con1 normal_btn_style">
                <div class="row">
                    <a href="/activity/you-donated"><i class="fas fa-file-alt"></i>My Transaction Record</a>
                </div>
            </div>
            <!-- end normal design -->

            <div class="w-100"></div> <!-- use this to seperate each button -->

            <!-- normal button design -->
            <div class="col left_btn_con1 normal_btn_style">
                <div class="row">
                    <a href="/leaderboards"><i class="fas fa-th-list"></i>Leaderboards</a>
                </div>
            </div>
            <!-- end normal design -->

            <div class="w-100"></div> <!-- use this to seperate each button -->

            <!-- normal button design -->
            <div class="col left_btn_con1 normal_btn_style">
                <div class="row">
                    <a href="{{ route('filterlocation2') }}"><i class="fas fa-sliders-h-square"></i>Filter Post</a>
                </div>
            </div>
            <!-- end normal design -->

            <div class="w-100"></div> <!-- use this to seperate each button -->

            <!-- normal button design -->
            <div class="col left_btn_con1 normal_btn_style">
                <div class="row">
                    @if(Auth::user()->accountType == "RECEPIENT")
                    <a href="/distribution/"><i class="fa fa-plus-circle" aria-hidden="true"></i>Distributions</a>
                    @else
                    <a href="/distribution/my"><i class="fa fa-plus-circle" aria-hidden="true"></i>Distributions</a>
                    @endif
                </div>
            </div>
            <!-- end normal design -->
            
        </div>
    </div>
</div>
<!-- end of left area -->

<!-- center and post area -->

<div class="col-6 center_area_con">
    <div class="container center_post_area">
        
        @if(Auth::user()->accountType == "RECEPIENT")
        <!-- create post container start -->
        <div class="row center_create_con" >
        @include('inc.messages')
            <div class="col-2">
                <img src="../storage/profile_images/{{Auth::user()->profileImage}}" class="center_user_pic" alt="">
            </div>
            <div class="col-9">
                <button class="center_create_btn" data-toggle="modal" data-target=".bd-example-modal-lg">
                    Create post...
                </button>
            </div>
        </div>   
        <!-- create post end -->
        @endif

        @if(Auth::user()->accountType == "DONOR")
        <!-- create post container start -->
        <div style="margin-top:8px;">
        @include('inc.messages')
        </div>
        
        <!-- create post end -->
        @endif
        
        
        <!-- post start here -->
        @php $idcount = 0; @endphp
        @if(count($posts) > 0)
        @foreach($posts as $post)

        @if($post->postUser2Id == NULL)
        <div class="row center_post_main_con">
            <div class="container">
                <!-- first row(user profile area) -->
                <div class="row post_profile_row">
                    <div class="col-2" >
                    @php $count = 0; $id = 0; @endphp
                        @if(count($follows) > 0)
                        @foreach($follows as $follow)
                            @if($follow->followedUserId == $post->id)
                                @if($follow->followUserId == Auth::user()->id)

                                    @php $count = 1; $id = $follow->followId; @endphp

                                @endif
                                
                            @endif
                        @endforeach
                        @endif

                        @if($post->id != Auth::user()->id)
                        @if($count == 1)

                        <i class="far fa-check check_follow"></i>
                        <img src="/storage/profile_images/{{$post->profileImage}}" class="center_user_post_pic" alt="">

                        @else
                        
                        <img src="/storage/profile_images/{{$post->profileImage}}" class="center_user_post_pic2" alt="">

                        @endif
                        @else
                        <img src="/storage/profile_images/{{$post->profileImage}}" class="center_user_post_pic2" alt="">
                        @endif
                        

                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="" style="width: auto;">
                                <a href="/users/profile/{{$post->id}}" class="post_user_name"  style="">{{$post->firstName." ".$post->middleName." ".$post->lastName." ".$post->orgName}}
                                </a> 
                            </div>               
                        </div>


                        
                        <div class="row">
                            <a href="" class="post_address">
                                <i class="fal fa-map-marker-alt"></i>
                                {{$post->postSector.", ".$post->postBarangay.", ".$post->postCity.", ".$post->province.", ".$post->postRegion}}
                            </a>
                        </div>
                        <!-- <div class="row">
                            <a href="" class="post_category">
                                <i class="fal fa-list-ul"></i>
                                {{$post->postCategory}}
                            </a>
                        </div> -->
                        <div class="row">
                            <a href="" class="post_time">
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
                    <div class="col-2">
                    <div class="three-dots-small" style="float:right;">
                    <div class="dropdown dots">

                        <button class="btn tdots" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter2-{{$post->postId}}">
                            <i class="fal fa-ellipsis-v fa-2x"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter2-{{$post->postId}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="height:auto;">
                                    

                                        @if(Auth::user()->id != $post->postUserId && $post->postStatus != "BANNED")

                                        <!-- follow/following button -->
                                        @php $count = 0; $id = 0; @endphp
                                        @if(count($follows) > 0)
                                        @foreach($follows as $follow)
                                            @if($follow->followedUserId == $post->id)
                                                @if($follow->followUserId == Auth::user()->id)

                                                    @php $count = 1; $id = $follow->followId; @endphp

                                                @endif
                                                
                                            @endif
                                        @endforeach
                                        @endif

                                        @if($post->id != Auth::user()->id)
                                        @if($count == 1)
                                        {!!Form::open(['action' => ['App\Http\Controllers\FollowController@destroy', $id], 'method' => 'POST'])!!}
                                        <input type="hidden" name="followpostid" value="{{$post->id}}">

                                        <button class="btn btn2" style="width:100%;text-align:left;" type="submit">Unfollow this User</button>
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {!!Form::close()!!}

                                        @else

                                        {!! Form::open(['action' => 'App\Http\Controllers\FollowController@store2', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                        <input type="hidden" name="followpostid" value="{{$post->id}}">
                                        
                                        <button class="btn btn2" style="width:100%;text-align:left;" type="submit">Follow this User</button>
                                        {!! Form::close() !!}
                                        @endif
                                        @endif
                                        <!-- follow/following button end -->

                                        <!-- post report -->
                                        <button class="btn btn2" style="width:100%;text-align:left;" type="button" onclick="document.getElementById('reportDiv{{$post->postId}}').style.display == 'none' ? document.getElementById('reportDiv{{$post->postId}}').style.display = 'inline' : document.getElementById('reportDiv{{$post->postId}}').style.display = 'none'">Report Post</button>
                                        <form action="{{route('report')}}" method="GET">
                                        <input type="hidden" name="userid" value="">
                                        <input type="hidden" name="postid" value="{{$post->postId}}">
                                        <input type="hidden" name="commentid" value="">
                                        <div class="row" id="reportDiv{{$post->postId}}" style="display:none;">
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
                                        <button class="btn btn2" style="width:100%;text-align:left;" type="button" onclick="document.getElementById('editDiv{{$post->postId}}').style.display == 'none' ? document.getElementById('editDiv{{$post->postId}}').style.display = 'inline' : document.getElementById('editDiv{{$post->postId}}').style.display = 'none'">Edit Post</button>
                                        <div class="row deleteDiv2" id="editDiv{{$post->postId}}" style="display:none; ">
                                            <div class="row">
                                            {!! Form::open(['action' => ['App\Http\Controllers\PostsController@update', $post->postId], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                                                <div class="form-group" style="margin-top:20px;">
                                                <label for="edit_post" style="background:#dbdcdd;padding:10px 10px 10px 20px;border-radius:5px;width:100%;">You may edit your caption:</label>
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
                                        <button class="btn btn2" style="width:100%;text-align:left;" type="button" onclick="document.getElementById('deleteDiv{{$post->postId}}').style.display == 'none' ? document.getElementById('deleteDiv{{$post->postId}}').style.display = 'inline' : document.getElementById('deleteDiv{{$post->postId}}').style.display = 'none'">Delete Post</button>
                                        <div class="row deleteDiv2" id="deleteDiv{{$post->postId}}" style="display:none; ">
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
                <!-- end of first row -->
                
                <!-- second row (post caption) -->
                <div class="row post_caption_con" style="display:flex;">
                   <h5 style="text-decoration:underline;">{{$post->postCategory}}</h5>
                   <p style="">{{$post->postCaption}}</p>
                </div>
                <!-- second row end -->

                <!-- third row (post image here) -->
                <div class="row post_image_con">
                    <a href="/home/{{$post->postId}}">
                        <img style="width:100%" src="/storage/cover_images/{{$post->postImageName}}" alt="">
                    </a>
                </div>
                <!-- third row end -->

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
                            <button class="post_donate_button" style="font-size:13px;">Stop Accepting Donation</button>
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
                    <a href="/home/{{$post->postId}}"><div>
                        <button class="post_donate_button" style="background-color:#00b919;">View Post</button>
                    </div></a>
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
                                        PHP <input style="border-radius: 10px;padding:5px;" type="text" name="amountDonated">
                                        </div>
                                        <input type="hidden" name="postid" value="{{$post->postId}}">
                                        <input type="hidden" name="postuserid" value="{{$post->postUserId}}">
                                        <input type="hidden" name="action" value="DONATE">
                                        <input type="hidden" name="paymenttype" value="GCASH">
                                        <input type="hidden" name="recepient" value="{{$post->postUserId}}">
                                        <input type="hidden" name="donor" value="{{Auth::user()->id}}">
                                        <input type="hidden" name="previous_url" value="/home">
                                        <input type="hidden" name="transaction" id="" value="YES">
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
                                    <div class="progress-bar2" style="width:3%;" ></div>
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

                <!-- fifth row (reaction area) -->
                <!-- use class .react_btn_active (blue design) -->
                <!-- use class .react_btn_style (grey design/default style) -->
                <div class="row react_button_row">

                    <!-- POST LIKES -->
                    <div class="col-4 button_react_con">
                        @php $count2 = 0; $likeid = 0; @endphp
                        @if(count($likes2) > 0)
                        @foreach($likes2 as $like)
                            @if($like->likePostId == $post->postId)
                                @if($like->likeUserId == Auth::user()->id)

                                    @php $count2 = 1; $likeid = $like->likeId; @endphp

                                @endif
                                
                            @endif
                        @endforeach
                        @endif

                        @if($count2 == 1)

                        {!!Form::open(['action' => ['App\Http\Controllers\LikeController@destroy', $likeid], 'method' => 'POST'])!!}
                        <input type="hidden" name="likepostid" value="{{$post->postId}}">
                        
                        <button class="react_btn_active">
                            <img src="../../images/wecare svg.svg" class="wecarelogo_svg" alt="">
                            <a href="">{{number_format($post->postLikes)}}</a>
                        </button>
                        {{Form::hidden('_method', 'DELETE')}}
                        {!!Form::close()!!}

                        @else

                        {!! Form::open(['action' => 'App\Http\Controllers\LikeController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <input type="hidden" name="likepostid" value="{{$post->postId}}">
                        <input type="hidden" name="likeuserid" value="{{$post->postUserId}}">
                        <button class="react_btn_style">
                            <img src="../../images/wecare svg.svg" class="wecarelogo_svg" alt="">
                            <a href="">{{number_format($post->postLikes)}}</a>
                        </button>
                        {!! Form::close() !!}

                        @endif
                        
                    </div>
                    <!-- /POST LIKES -->

                    <!-- POST COMMENTS -->
                    <div class="col-4 button_react_con">
                        @if(count($comment) >= 0)
                        @php $com = 0 @endphp
                        @foreach($comment as $c)
                            @if($post->postId == $c->commentPostId)
                                @php $com++ @endphp
                            @endif
                        @endforeach
                        <form action="/home/{{$post->postId}}">
                        <button class="react_btn_style_form" >
                            <div class="row">
                                <div class="col-w1">
                                    <i class="fas fa-comment-alt"></i>
                                </div>

                                <div class="col-w2">
                                    <a href="">{{number_format($com)}}</a>
                                </div>
                            </div>
                        </button>
                        </form>
                        @endif
                    </div>
                    <!-- /POST COMMENTS -->

                    <!-- POST SHARE -->
                    <div class="col-4 button_react_con" data-toggle="modal" data-target="#epostModal3-{{$post->postId}}">
                        <button class="react_btn_style">
                            <i class="fas fa-share"></i>
                            <a href="">Share</a>
                        </button>
                    </div>
                    <!-- /POST SHARE -->
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


                </div>
                <!-- fifth row end -->
            </div>
        </div>
        @endif

        @endforeach
        @else
        @endif
        <!-- post end here -->

    </div>
</div>
<!-- end of post area -->


<!-- right area -->
<div class="col-3 right_panel_parent_con" >
    <div class="container right_con_top">
        <div class="row right_suggest_people">
            <div class="col-12 right_people_head">
                Suggested People
            </div>
            <div class="col-12">
                <div class="row right_people_content">
                    <div class="">
                        <!-- ever row profile start here -->
                        @if(count($user) > 0)
                        @foreach($user as $u)

                        
                        <a href="/users/profile/{{$u->id}}">
                        <div class="row right_profile_suggest">
                            <div class="col-3">
                                <img src="/storage/profile_images/{{$u->profileImage}}" class="right_suggest_pic" alt="">
                            </div>
                            <div class="col-9">
                                <div class="row right_suggest_name">
                                {{$u->firstName." ".$u->middleName." ".$u->lastName." ".$u->orgName}}
                                </div>
                                
                                @php $count = 0; $id = 0; @endphp
                                @if(count($follows) > 0)
                                @foreach($follows as $follow)
                                    @if($follow->followedUserId == $u->id)
                                        @if($follow->followUserId == Auth::user()->id)

                                            @php $count = 1; $id = $follow->followId; @endphp

                                        @endif
                                        
                                    @endif
                                @endforeach
                                @endif

                                @if($u->id != Auth::user()->id)
                                @if($count == 1)
                                {!!Form::open(['action' => ['App\Http\Controllers\FollowController@destroy', $id], 'method' => 'POST'])!!}
                                <input type="hidden" name="followpostid" value="{{$u->id}}">

                                <div class="row right_suggest_follow">
                                    <button type="submit" style="margin-top:20px;margin-left:25px;">
                                        <i class="fal fa-user-check following-icon"> Following</i>
                                    </button>
                                </div>
                                {{Form::hidden('_method', 'DELETE')}}
                                {!!Form::close()!!}

                                @else

                                {!! Form::open(['action' => 'App\Http\Controllers\FollowController@store2', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                <input type="hidden" name="followpostid" value="{{$u->id}}">
                                
                                <div class="row right_suggest_follow">
                                    <button type="submit" style="margin-top:20px;margin-left:25px;">
                                        <i class="fal fa-user-plus follow-icon" >Follow</i>
                                    </button>
                                </div>
                                {!! Form::close() !!}
                                @endif
                                @endif
                            </div>
                        </div>
                        </a>
                        @endforeach
                        @else
                        <div class="row right_profile_suggest">
                            <div class="col-9">
                                <div class="row right_suggest_name">
                                    No User
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- row end here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container right_con_bot">
        <div class="row right_suggest_people">
            <div class="col-12 right_people_head">
                Suggested Post
            </div>
            <div class="col-12">
                <div class="row right_people_content">
                    <div class="">
                        <!-- ever row profile start here -->
                        @if(count($posts2) > 0)
                        @foreach($posts2 as $post)

                        @if($post->postUser2Id == NULL || $post->postStatus == "REPOST")
                        <a href="/home/{{$post->postId}}">
                        <div class="row right_profile_suggest">
                            <div class="col-3">
                                <img src="/storage/profile_images/{{$post->profileImage}}" class="right_suggest_pic" alt="">
                            </div>
                            <div class="col-9">
                                <div class="row right_suggest_name">
                                {{$post->firstName." ".$post->middleName." ".$post->lastName." ".$post->orgName}}
                                </div>
                                <div class="row right_suggest_post">
                                    <div class="col" >
                                        <button>
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
                                        </button>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        </a>
                        @endif
                        @endforeach
                        @else
                        <div class="row right_profile_suggest">
                            <div class="col-9">
                                <div class="row right_suggest_name">
                                    No post
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- row end here -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end of right area -->
    </div>
    </div>

<!-- lower panel -->
<div class="lower_panel">
    <div class="row lower_row_1">
        <div class="col lower_icon_active">
        <a href="">
            <i class="fas fa-th-large"></i>
        </a>
        </div>

        <div class="col lower_icon_normal">
        <a href="">
            <i class="fas fa-file-alt"></i>
        </a>
        </div>

        <div class="col lower_icon_normal">
        <a href="">
            <i class="fas fa-th-list"></i>
        </a>
        </div>

        <div class="col lower_icon_normal">
        <a href="">
            <i class="fas fa-sliders-h-square"></i>
        </a>
        </div>
    </div>
</div>

@if(Auth::user()->accountVerified == "VERIFIED")
<!-- create post modal-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {!! Form::open(['action' => 'App\Http\Controllers\PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="modal-body">   
                    <div class="col-sm-12" style="display:flex;">
                            <div class="row modal_row_title" style="width:200px;position:relative;">Title of your Post: <small style="">(Ex: Fire in Mandaue City)</small></div>
                            <div class="row modal_input_amount" style="width:100%;margin-left:20px;">
                                <input type="text" name="category" id="" >
                            </div>
                        </div> <br>
                    <div class="row post_textarea_row">

                        

                        <textarea name="caption" id="" cols="30" rows="7" class="modal_post_textarea"placeholder="Write a description..."></textarea>
                    </div>
                    <div class="row">
                        <div class="container">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="modal_row_title">Upload Image</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file">
                                                Add image<input type="file" id="imgInp" name="cover_image">
                                            </span>
                                        </span>
                                        <input  type="text" class="form-control" readonly>
                                    </div>
                                    <img id='img-upload'/>
                                </div>
                            </div>
                            <!-- target amount -->
                            <div class="col-sm-6" style="margin-left:20px;">
                                <div class="row modal_row_title">How much is your target amount for this post?</div>
                                <div class="row modal_input_amount"><small>PHP</small><input name="amountTarget" type="text" placeholder="PHP"></div>
                            </div> <br>
                            <!-- //target amount -->
                            
                        </div>
                    </div>
                    
                    <div class="row post_modal_row3">
                    <div class="row modal_row_title_dark">Please fill out these neccesary information..</div> <br>
                        
                    </div>

                    <div class="row post_modal_row4">
                        <div class="col-12">
                            <br>
                            <label for="" class="modal_row_title">Where was this happened?</label>
                                    <!--Address input-->
                                    <div class="container-drop">
                                        <div class="row">

                                            <div class="col-sm" style="margin-top:10px;">
                                                <small>Select Region</small>
                                                <select class="form-select modal_input_select" aria-label="Default select example" name="region"> 
                                                    <option value="{{Auth::user()->region}}" selected hidden>{{Auth::user()->region}}</option>
                                                    <option value="">Region 7</option>
                                                </select>

                                            </div>

                                            <div class="col-sm" style="margin-top:10px;">
                                                <small>Select Province</small>
                                                <select class="form-select modal_input_select" aria-label="Default select example" name="province"> 
                                                    <option value="{{Auth::user()->province}}" selected hidden>{{Auth::user()->province}}</option>
                                                    <option value="">Cebu</option>
                                                </select>

                                            </div>

                                            <div class="w-100" style="margin-top:10px;"> </div>

                                            <div class="col-sm" style="margin-top:10px;">
                                                <small>Select City</small>
                                                <select class="form-select modal_input_select" aria-label="Default select example" onchange="myFunction()" id="selectedCity" name="city"> 
                                                    <option value="{{Auth::user()->city}}" selected hidden>{{Auth::user()->city}}</option>
                                                    <option value="Mandaue">Mandaue</option>
                                                    <option value="Lapu-Lapu">Lapu-Lapu</option>
                                                </select>

                                            </div>

                                            <div class="col-sm" style="margin-top:10px;">
                                                <small>Select Barangay</small>
                                                <select class="form-select modal_input_select" aria-label="Default select example" style="display:none;" id="city1" name="barangay1" onchange=getBarangay1()>
                                                    <option value="{{Auth::user()->barangay}}" selected hidden>{{Auth::user()->barangay}}</option>
                                                    <option value="Alang-alang">Alang-alang</option>
                                                    <option value="Bakilid">Bakilid</option>
                                                    <option value="Banilad">Banilad</option>
                                                    <option value="Basak">Basak</option>
                                                    <option value="Cabancalan">Cabancalan</option>
                                                    <option value="Cambaro">Cambaro</option>
                                                    <option value="Canduman">Canduman</option>
                                                    <option value="Casili">Casili</option>
                                                    <option value="Casuntingan">Casuntingan</option>
                                                    <option value="Centro">Centro</option>
                                                    <option value="Cubacub">Cubacub</option>
                                                    <option value="Guizo">Guizo</option>
                                                    <option value="Ibabao-Estancia">Ibabao-Estancia</option>
                                                    <option value="Jagobiao">Jagobiao</option>
                                                    <option value="Labogon">Labogon</option>
                                                    <option value="Looc">Looc</option>
                                                    <option value="Maguikay">Maguikay</option>
                                                    <option value="Mantuyong">Mantuyong</option>
                                                    <option value="Opao">Opao</option>
                                                    <option value="Pakna-an">Pakna-an</option>
                                                    <option value="Pagsabungan">Pagsabungan</option>
                                                    <option value="Subangdaku">Subangdaku</option>
                                                    <option value="Tabok">Tabok</option>
                                                    <option value="Tawason">Tawason</option>
                                                    <option value="Tingub">Tingub</option>
                                                    <option value="Tipolo">Tipolo</option>
                                                    <option value="Umapad">Umapad</option>
                                                </select>

                                                <select class="form-select modal_input_select" aria-label="Default select example" id="city2" style="display:none;" name="barangay1" onchange=getBarangay2()>
                                                    <option value="{{Auth::user()->barangay}}" selected hidden>{{Auth::user()->barangay}}</option>
                                                    <option value="Agus">Agus</option>
                                                    <option value="Babag">Babag</option>
                                                    <option value="Bankal">Bankal</option>
                                                    <option value="Baring">Baring</option>
                                                    <option value="Basak">Basak</option>
                                                    <option value="Buaya">Buaya</option>
                                                    <option value="Calawisan">Calawisan</option>
                                                    <option value="Canjulao">Canjulao</option>
                                                    <option value="Caw-oy">Caw-oy</option>
                                                    <option value="Cawhagan">Cawhagan</option>
                                                    <option value="Caubian">Caubian</option>
                                                    <option value="Gun-ob">Gun-ob</option>
                                                    <option value="Ibo">Ibo</option>
                                                    <option value="Looc">Looc</option>
                                                    <option value="Mactan">Mactan</option>
                                                    <option value="Maribago">Maribago</option>
                                                    <option value="Marigondon">Marigondon</option>
                                                    <option value="Opon">Opon</option>
                                                    <option value="Pajac">Pajac</option>
                                                    <option value="Pajo">Pajo</option>
                                                    <option value="Pangan-an">Pangan-an</option>
                                                    <option value="Punta Engaño">Punta Engaño</option>
                                                    <option value="Pusok">Pusok</option>
                                                    <option value="Sabang">Sabang</option>
                                                    <option value="Santa Rosa">Santa Rosa</option>
                                                    <option value="Subabasbas">Subabasbas</option>
                                                    <option value="Talima">Talima</option>
                                                    <option value="Tingo">Tingo</option>
                                                    <option value="Tungasan">Tungasan</option>
                                                    <option value="San Vicente">San Vicente</option>
                                                </select>

                                                <select class="form-select modal_input_select" aria-label="Default select example" id="city0" style="display:block;" disabled>
                                                    <option value="{{Auth::user()->barangay}}" selected hidden>{{Auth::user()->barangay}}</option>
                                                </select>

                                            </div>

                                            <input type="hidden" id="citt" name="city" value="{{Auth::user()->city}}">
                                            <input type="hidden" id="barr" name="barangay" value="{{Auth::user()->barangay}}">
                                                
                                            <div class="purokinput">
                                                <small>Enter Street/Purok/Building No./House No.</small>
                                                <input type="text" name="sector" class="form-control" value="{{Auth::user()->sector}}">                                                   
                                            </div>

                                        </div>

                                    </div> <!--/Address inputs-->

                                    
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary primary_btn">Post</button>
                    <button type="button" class="btn btn-secondary second_btn" data-dismiss="modal">Close</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- last post modal -->
@else
<!-- create post modal-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <div class="modal-body">   
                   <p>Your account is not yet verified to proceed this action, please submit a verification request to our Admins. Thanks!</p> 

                   <p>To submit, please go to your timeline page and click the three vertical dots at the upper right of the page.</p>

                   <p>If you have already submitted, please wait within 30 days upon submission to verify your account.</p>
                    
                   <p>You may also contact Admin Support for follow-ups that can also be found in your timeline page, below the three vertical dots.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary second_btn" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>
@endif
<!-- /body container here -->



@endsection