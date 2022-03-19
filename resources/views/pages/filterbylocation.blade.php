<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../style/poststyle.css" rel="stylesheet" type="text/css" >
    <link href="../../style/navstyle2.css" rel="stylesheet" type="text/css" >
    <link href="../../style/filterbyloc.css" rel="stylesheet" type="text/css" >
    <link href="../../style/socialmediabuttons.css" rel="stylesheet" type="text/css" >
    <link rel="shortcut icon" href="{{ asset('images/wecarelogo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    
    <!-- Meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

     <!-- jQuery -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

     <!-- Share JS -->
     <script src="{{ asset('js/share.js') }}"></script>

    <title>Filter by location</title>
</head>
<body>
    
    <div class="sticky-top">
    @extends('layouts.topbar_users2')
    </div>

    <!-- search by location -->
    
    <div class="out-con">
        <div class="col-12 row-title">
            <label for="" class="filter-title">Filter by Preference</label>
        </div>
        <form action="{{ route('filterlocation') }}" method="GET">
        <div class="row">
            <div class="col-12 left-hand-con">
                <div class="row">
                    <div class="col-4" >
                        <small>Category</small>
                        <select class="form-select" name="category"> 
                            <option value="{{$category == '' ? 'All' : $category}}">{{$category == "" ? 'All' : $category}}</option>
                            <option value="All">All</option>
                            <option value="Calamity">Calamity</option>
                            <option value="Children">Children</option>
                            <option value="Animals">Animals</option>
                            <option value="Medical">Medical</option>
                            <option value="Youth">Youth</option>
                            <option value="Seniors">Seniors</option>
                            <option value="Memorial">Memorial</option>
                        </select>
                    </div>
                    <div class="col-4" >
                        <small>Region</small>
                        <select class="form-select" name="region"> 
                            <option value="{{$region == '' ? 'Region 7' : $region}}" selected hidden>{{$region == '' ? 'Region 7' : $region}}</option>
                            <option value="Region 7">Region 7</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <small>Province</small>
                        <select class="form-select" name="province"> 
                            <option value="{{$province == '' ? 'Cebu' : $province}}" selected hidden>{{$province == '' ? 'Cebu' : $province}}</option>
                            <option value="Cebu">Cebu</option>
                        </select>
                    </div>
                </div> <!-- row 1 of address -->

                <div class="row">
                    <div class="col-4" >
                        <small>City</small>
                        <select class="form-select" aria-label="Default select example" onchange="myFunction()" id="selectedCity" name="city"> 
                            <option value="{{$city == '' ? '' : $city}}" selected hidden>{{$city == '' ? 'All' : $city}}</option>
                            <option value="">---Select All---</option>
                            <option value="Mandaue">Mandaue</option>
                            <option value="Lapu-Lapu">Lapu-Lapu</option>
                        </select>
                    </div>
                    <div class="col-4" >
                        <small>Barangay</small>
                        <!-- barangays of Mandaue -->
                        <select class="form-select" aria-label="Default select example" style="display:none;" id="city1" name="barangay1">
                            <option value="" selected hidden></option>
                            <option value="">---Select All---</option>
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
                        <!-- /barangays of Mandaue -->
                        <!-- barangays of Lapu-lapu -->
                        <select class="form-select" aria-label="Default select example" id="city2" style="display:none;" name="barangay2">
                            <option value="" selected hidden></option>
                            <option value="">---Select All---</option>
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
                        <!-- /barangays of Lapu-lapu -->

                        <select class="form-select" aria-label="Default select example" id="city0" style="display:block;" disabled>
                            <option value="{{$barangay == '' ? '' : $barangay}}" selected hidden>{{$barangay == '' ? 'All' : $barangay}}</option>
                            <option value="">---Select All---</option>
                        </select>
                    </div>

                    <div class="col-4 btn-con">
                        <small style="color:white;">Search</small>
                        <br>
                        <button type="submit" class="btn-search">
                            Search
                        </button>
                    </div>
                </div> <!-- row 2 of address -->
            </div>
        </div><!-- /search by location -->
        </form>
    
    <!-- post area/body -->
    <div class="container" style="margin-top:1%;">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
            @if(count($posts) > 0)
<!--post -->        @foreach($posts as $post)
                    <!-- post start here -->
                    <div class="row center_post_main_con">
            <div class="container">
                <!-- first row(user profile area) -->
                <div class="row post_profile_row">
                    <div class="col-2" >
                        <img src="/storage/profile_images/{{$post->profileImage}}" class="center_user_post_pic" alt="">
                    </div>
                    <div class="col-8">

                        <div class="row">
                            <div class="col">
                            <a href="/users/profile/{{$post->id}}" class="post_user_name"  style="">{{$post->firstName." ".$post->middleName." ".$post->lastName." ".$post->orgName}}
                            </a> 
                                <!-- <span class="timeline_post_follow">
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

                                <button type="submit">
                                    following
                                </button>
                                {{Form::hidden('_method', 'DELETE')}}
                                {!!Form::close()!!}

                                @else

                                {!! Form::open(['action' => 'App\Http\Controllers\FollowController@store2', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                <input type="hidden" name="followpostid" value="{{$post->id}}">

                                <button type="submit">
                                    follow
                                </button>
                                {!! Form::close() !!}
                                @endif
                                @endif
                                </span> -->
                            </div>
                        </div>



                        
                        <div class="row">
                            <a href="" class="post_address">
                                <i class="fal fa-map-marker-alt"></i>
                                {{$post->postSector.", ".$post->postBarangay.", ".$post->postCity.", ".$post->province.", ".$post->postRegion}}
                            </a>
                        </div>
                        <div class="row">
                            <a href="" class="post_category">
                                <i class="fal fa-list-ul"></i>
                                {{$post->postCategory}}
                            </a>
                        </div>
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

                    <div class="col-2 col_center_3dots">
                        <button class="button_dots">
                            <i class="far fa-ellipsis-v" data-toggle="modal" data-target="#exampleModalCenter2-{{$post->postId}}"></i>
                            
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
                                    <div class="modal-body">
                                        @if(Auth::user()->id != $post->postUserId)
                                        <button class="btn" style="width:100%;text-align:left;" type="button" disabled>Report this post:</button>
                                            <form action="{{route('report')}}" method="GET">
                                            <input type="hidden" name="userid" value="">
                                            <input type="hidden" name="postid" value="{{$post->postId}}">
                                            <input type="hidden" name="commentid" value="">
                                            <div class="row" id="reportDiv" style="display:block;">
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
                                                    <div class="form-check">
                                                        <button type="submit" class="btn-report-2">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>


                                           @elseif(Auth::user()->id == $post->postUserId && $post->postStatus == "PROCESS") 
                                            <button class="btn" style="width:100%;text-align:left;" type="button" disabled>Delete Post</button>
                                            <div class="row deleteDiv2" id="deleteDiv" style="display:block; ">
                                                <div class="row">
                                                    <div class="col">
                                                        Are you sure you want to delete this? 
                                                        {{$post->postUserId." ".$post->postId}}
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    {!!Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->postId], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                                    <div class="col-5">
                                                        <div class="form-check">
                                                            <button type="submit" class="btn-delete-yes">Yes</button>
                                                        </div>
                                                    </div>  
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    {!!Form::close()!!}
                                                    <div class="col-5">
                                                        <div class="form-check">
                                                            <button class="btn-delete-no">No</button>
                                                        </div>
                                                    </div>                                       
                                                </div>
                                            </div>
                                            @elseif($post->postStatus == "BANNED")
                                            <div>This post is Banned.</div>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of first row -->
                
                <!-- second row (post caption) -->
                <div class="row post_caption_con">
                {{$post->postCaption}}
                </div>
                <!-- second row end -->

                <!-- third row (post image here) -->
                <div class="row post_image_con">
                    <a href="/home/{{$post->postId}}">
                        <img style="width:100%" src="/storage/cover_images/{{$post->postCoverImage}}" alt="">
                    </a>
                </div>
                <!-- third row end -->

                <!-- fourth row (donation area) -->
                <div class="row post_donation_con">
                    <div class="col-4">
                        @if($post->postReceivedAmount < $post->postTargetAmount && Auth::user()->id != $post->postUserId && $post->postStatus != "BANNED" && $post->postStatus == "VERIFIED")
                        <div data-toggle="modal" data-target="#mpostModal2-{{$post->postId}}">
                            <input type="hidden" name="postid" value="{{$post->postId}}">
                            <button class="post_donate_button">Donate</button>
                        </div>
                        @elseif($post->postStatus == "BANNED")
                        <button class="post_donate_button_disabled" style="background-color:#90A4AE;cursor: no-drop;color:white;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Post Banned</button>
                        @else
                        <button class="post_donate_button_disabled" style="cursor: no-drop;">Donate</button>
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
                                        <input type="hidden" name="previous_url" value="users/profile/{{$post->id}}">
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
                        @php $count2 = 0; $likeid =0; @endphp
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
                        <button class="react_btn_style" style="height:31px;">
                            <i class="fas fa-comment-alt"></i>
                            <a href="">{{number_format($com)}}</a>
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
                    <!-- post end here -->
                    @endforeach
                    @else
                    @endif

                    
                </div>
            </div>
            <!-- end of post area -->
                

            </div>
        </div>
    </div>
    <!-- //post area/body -->


</div>

    

    <div class="fixed-bottom" style="">
        <div class="low-panel">
            <div class="row">
                <div class="col">
                    <button class="btnfeed">
                        <i class="fas fa-th-large fa-lg lowcolor"></i>
                    </button>                   
                </div>

                <div class="col">
                    <i class="fal fa-clone fa-lg " style="color:white;"></i>
                </div>

                <div class="col">
                    <i class="fal fa-chart-line fa-lg" style="color:white;"></i>
                </div>
            </div>
        </div>
    </div>
    <script>
            //$("#selectid").find("option").eq(0).remove();
            $('select > option:first').hide();
    </script>
    <script>
        function myFunction() {
            var selectedCity = document.getElementById("selectedCity").value;
            var mandaue = document.getElementById("city1");
            var lapu = document.getElementById("city2");
            var none = document.getElementById("city0");

            if (selectedCity == "Mandaue") {
                mandaue.style.display = "block";
                lapu.style.display = "none";
                none.style.display = "none";
                document.getElementById("city1").value = "";
            } else if (selectedCity == "Lapu-Lapu"){
                mandaue.style.display = "none";
                lapu.style.display = "block";
                none.style.display = "none";
                document.getElementById("city2").value = "";
            }else if (selectedCity == ""){
                mandaue.style.display = "none";
                lapu.style.display = "none";
                none.style.display = "block";
                document.getElementById("city0").value = "";
            } 
        }
    </script>

    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!--/jquery-->
    
    <!--Javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <!--/script-->
    </script>
    
</body>
</html>