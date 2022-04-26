@extends('layouts.user_layout')

@section('content')

<link href="../../style/timeline.css" rel="stylesheet" type="text/css" >
<style>
    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
  
  td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }
  
  tr:nth-child(even) {
    background-color: #dddddd;
  }

  input[type=checkbox] {
  display: none;
}
</style>
<div class="wide-con" style="border:1px solid white; ">
    <div class="row inner-row">

            <div class="pic-area" >
                <div class="row home_btn">
                    <a href="/home"><i class="fas fa-home fa-md"></i></a>
                </div>
                <div class="three-dots-small">
                    <div class="dropdown dots42">
                        <button class="btn tdots42" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter2-{{$user->id}}">
                            <i class="fal fa-ellipsis-v fa-2x"></i>
                        </button>
                        <!-- 3 dots Modal mobile -->
                        <div class="modal fade" id="exampleModalCenter2-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    You want to report this user for:
                                </div>
                                <div class="modal-body">
                                <form action="{{route('report')}}" method="GET">
                                    <input type="hidden" name="userid" value="{{$user->id}}">
                                    <input type="hidden" name="postid" value="">
                                    <input type="hidden" name="commentid" value="">
                                    <div class="row" id="reportDiv" style="display:block;">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reportDescription" id="exampleRadios1-{{$user->postId}}" value="Inappropriate" onclick="document.getElementById('custom-{{$user->postId}}').disabled = true">
                                                <label class="form-check-label" for="exampleRadios1-{{$user->postId}}">
                                                Inappropriate
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reportDescription" id="exampleRadios2-{{$user->postId}}" value="Scam" onclick="document.getElementById('custom-{{$user->postId}}').disabled = true">
                                                <label class="form-check-label" for="exampleRadios2-{{$user->postId}}">
                                                Scam
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reportDescription" id="exampleRadios3-{{$user->postId}}" value="False Information" onclick="document.getElementById('custom-{{$user->postId}}').disabled = true">
                                                <label class="form-check-label" for="exampleRadios3-{{$user->postId}}">
                                                False Information
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reportDescription" id="exampleRadios4-{{$user->postId}}" value="Vulgar" onclick="document.getElementById('custom-{{$user->postId}}').disabled = true">
                                                <label class="form-check-label" for="exampleRadios4-{{$user->postId}}">
                                                Vulgar
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reportDescription" id="exampleRadios6-{{$user->postId}}" value="Vulgar" onclick="document.getElementById('custom-{{$user->postId}}').disabled = false">
                                                <label class="form-check-label" for="exampleRadios6-{{$user->postId}}" style="width:400px;">
                                                Other: <small>(Please tell us, so we can understand.)</small> 
                                                </label>
                                                <textarea type="text" name="reportDescription" id="custom-{{$user->postId}}" placeholder="" style="width:400px;height:100px;" required disabled></textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <button type="submit" class="btn-report-2">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="row icon-message-con-small">
                        <button class="btn-icon-message-small tdots42" data-toggle="modal" data-target="#exampleModalCenterMessage2">
                            <i class="fas fa-user-headset fa-lg"></i>
                        </button>
                        <!-- /3 dots Modal mobile-->

                        <div class="modal fade" id="exampleModalCenterMessage2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Messages</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row message-content">
                                        <div class="col">
                                        @if(count($vars) > 0)
                                        @foreach($vars as $var)
                                        @if($var->inquirySentToId == Auth::user()->id)
                                            <div class="row admin-message" >
                                                <div class="col-2">
                                                    <img src="/storage/profile_images/{{$var->profileImage}}.jpg" class="img-msg-user" alt="">
                                                </div>
                                                <div class="col-10 admin-msg-con1">
                                                    <div class="col info-msg-user">
                                                        <small class="admin-msg-name">Admin</small>
                                                        <small class="admin-msg-time">{{date('F j, Y h:i A', strtotime($var->inquiryCreatedAt))}}</small>
                                                    </div>
                                                    
                                                    <div class="w-100"></div>
                                                    <label>{{$var->inquiryMessage}}</label>
                                                </div>
                                            </div>
                                            @endif

                                            @if($var->inquiryUserId == Auth::user()->id)
                                            <div class="row user-message">
                                                <div class="col-10 user-msg-con1">
                                                        
                                                    <div class="info-msg-user">
                                                        <small class="user-msg-name">You</small>
                                                        <small class="user-msg-time">{{date('F j, Y h:i A', strtotime($var->inquiryCreatedAt))}}</small>
                                                    </div>
                                                    <div class="w-100"></div>

                                                        <label >{{$var->inquiryMessage}}</label>             
                                                </div>
                                                <div class="col-2">
                                                    <img src="../storage/profile_images/{{$user->profileImage}}.jpg" class="img-msg-user" alt="">
                                                </div>
                                            </div>
                                            @endif

                                            @endforeach
                                            @endif

                                        </div>
                                    </div>

                                    <form class="msger-inputarea" action="{{route('inquiryToAdmin')}}" method="GET">
                                    <div class="row type-row">
                                    
                                        <input type="hidden" name="receiverid" value="1">
                                        <div class="col-9 message-type">
                                            <textarea type="text" name="inquirymessage" rows="3"class="message-input" placeholder="Ask your question..."></textarea>
                                        </div>
                                        <div class="col-3 btn-msg-con" >
                                            <button type="submit" class="btn-msg-submit">
                                                <i class="fas fa-paper-plane"></i>
                                                Send
                                            </button>
                                        </div>
                                    
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    </div>
                    </div>
                </div>
                
                <div class="pic-con">
                    <img data-toggle="modal" data-target="#picpostModal2" src="/storage/profile_images/{{$user->profileImage}}" class="img-con-3" alt="">
                </div>
                

                        <!-- Modal OF profile pic BUTTON-->
                        <div class="modal fade" id="picpostModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="" >
                            <div class="modal-dialog" role="document" style="margin-top:-1px;margin-bottom:-9px;">
                                <div class="modal-content" >
                                    <div class="modal-body" style="left:-100px;width:650px;height:620px;overflow: hidden;background-color:white; padding-top:-100px;">
                                        <img src="/storage/profile_images/{{$user->profileImage}}" class="" alt="" style="width:100%;height:100%;object-fit:cover;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /END Modal OF profile pic BUTTON -->
            </div>

            <div class="w-100 seperator"></div>

            <div class="info-con-2">
                <div class="col-12">
                    <label for="" class="for-name">{{$user->firstName." ".$user->middleName." ".$user->lastName." ".$user->orgName}}</label>
                    @if($user->accountVerified == "VERIFIED")
                    <i class="fa fa-check-circle verified-icon" aria-hidden="true" style=""></i>
                    @else
                    @endif
                </div>
                <div class="col-12 follow-hold">
                    <div class="row">
                        @if($user->accountType == "DONOR")
                        <div class="follow-col1">
                            <label for="" class="for-follow">Donated: PHP {{number_format($user->amountGiven, 2)}}</label>
                        </div>
                        @else
                        <div class="follow-col2">
                            <label for="" class="for-follow">Received: PHP {{number_format($user->amountReceived, 2)}}</label>
                        </div>
                        @endif
                    </div>                   
                </div>
                <div class="col-12">
                    <div class="row badge-info-con">
                        <div type="button" class="col-12 badge-wrap" data-toggle="modal" data-target="#exampleModalCenter">
                            @if(count($badge) > 0)
                            @foreach($badge as $b)
                                @if($user->id == $b->badgeUserId)
                                @if($b->badgeType == "GOLD")
                                    <img src="../../images/caregold.png" style="width:35px;height:35px;" alt="">
                                    @if($b->badgeFilterLocation == "PROVINCE")
                                        <label for="" class="badge-title">{{$b->province}} no. 1</label> 
                                        <label for="" class="badge-date">({{date('F j, Y', strtotime($b->badgeUpdatedAt))}})</label>
                                    @elseif($b->badgeFilterLocation == "CITY")
                                        <label for="" class="badge-title">{{$b->city}} no. 1 </label>
                                        <label for="" class="badge-date">({{date('F j, Y', strtotime($b->badgeUpdatedAt))}})</label>
                                    @elseif($b->badgeFilterLocation == "BARANGAY")
                                        <label for="" class="badge-title">{{$b->barangay}} no. 1</label> 
                                        <label for="" class="badge-date">{{date('F j, Y', strtotime($b->badgeUpdatedAt))}}</label>
                                    @endif
                                @elseif($b->badgeType == "SILVER")
                                        <img src="../../images/caresilver.png" style="width:35px;height:35px;" alt="">
                                        @if($b->badgeFilterLocation == "PROVINCE")
                                        <label for="" class="badge-title">{{$b->province}} no. 2</label>
                                        <label for="" class="badge-date">{{date('F j, Y', strtotime($b->badgeUpdatedAt))}}</a>
                                        @elseif($b->badgeFilterLocation == "CITY")
                                        <label for="" class="badge-title">{{$b->city}} no. 2</label>
                                        <label for="" class="badge-date">{{date('F j, Y', strtotime($b->badgeUpdatedAt))}}</label>
                                        @elseif($b->badgeFilterLocation == "BARANGAY")
                                        <label for="" class="badge-title">{{$b->barangay}} no. 2</label>
                                        <label for="" class="badge-date">{{date('F j, Y', strtotime($b->badgeUpdatedAt))}}</label>
                                        @endif
                                @elseif($b->badgeType == "BRONZE")
                                    <img src="../../images/carebronze.png" style="width:35px;height:35px;" alt="">
                                    @if($b->badgeFilterLocation == "PROVINCE")
                                    <label for="" class="badge-title">{{$b->province}} no. 3</label>
                                    <label for="" class="badge-date">{{date('F j, Y', strtotime($b->badgeUpdatedAt))}}</label>
                                    @elseif($b->badgeFilterLocation == "CITY")
                                    <label for="" class="badge-title">{{$b->city}} no. 3</label>
                                    <label for="" class="badge-date">{{date('F j, Y', strtotime($b->badgeUpdatedAt))}}</label>
                                    @elseif($b->badgeFilterLocation == "BARANGAY")
                                    <label for="" class="badge-title">{{$b->barangay}} no. 3</label>
                                    <label for="" class="badge-date">{{date('F j, Y', strtotime($b->badgeUpdatedAt))}}</label>
                                    @endif
                                @endif
                                @endif
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="text-align:left;">
                                    <form action="{{route('badge_delete')}}" method="GET">
                                    @if(count($badge) > 0)
                                    @foreach($badge as $b)
                                        <input type="hidden" name="badgeid" value="{{$b->badgeId}}">
                                        <button type="submit" class="btn" style="width:100%;text-align:left;">Remove Badge</button>
                                    @endforeach
                                    @endif
                                    </form>

                                    <form action="/badge-certificate" method="GET">
                                    @if(count($badge) > 0)
                                    @foreach($badge as $b)
                                        <input type="hidden" name="badgeid" value="{{$b->badgeId}}">
                                        <button type="submit" class="btn" style="width:100%;text-align:left;">Get your Certificate</button>
                                    @endforeach
                                    @endif

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 buttons-con" style="">
                    <div class="row">
                        <!-- followers/following -->
                        @php $followers = 0 @endphp
                        @php $following = 0 @endphp
                        @if(count($follows) > 0)
                        @foreach($follows as $f)
                        @if($f->followUserId == $user->id)
                            @php $following++ @endphp
                        @endif
                        @if($f->followedUserId == $user->id)
                            @php $followers++ @endphp
                        @endif
                        @endforeach
                        @endif

                        
                        <div class="donated-con">
                        @if($user->id != Auth::user()->id)
                            <button class="donated-btn">
                                {{number_format($followers)}}
                                <div class="col small" style="">Followers</div>
                            </button>
                        @endif
                        </div>
                        <div class="received-con">
                        @if($user->id != Auth::user()->id)
                            <button class="received-btn">
                                {{number_format($following)}}
                                <div class="col small" style="">Following</div>
                            </button>
                        @endif
                        </div>
                        <!-- /followers / following -->
                        <!-- follow -->
                        <div class="follow-con">
                        

                            @php $count = 0 @endphp
                            @if(count($follows) > 0)
                            @foreach($follows as $follow)
                                @if($follow->followedUserId == $user->id)
                                    @if($follow->followUserId == Auth::user()->id)

                                        @php $count = 1 @endphp

                                    @endif
                                    
                                @endif
                            @endforeach
                            @endif

                            @if($user->id != Auth::user()->id)
                            @if($count == 1)
                            {!!Form::open(['action' => ['App\Http\Controllers\FollowController@destroy', $user->id], 'method' => 'POST'])!!}
                            <button type="submit" class="follow-btn42">
                                <i class="fal fa-check" style=""></i> <a>Following</a> 
                            </button>
                            {{Form::hidden('_method', 'DELETE')}}
                            {!!Form::close()!!}

                            @elseif($count == 0)

                            {!! Form::open(['action' => 'App\Http\Controllers\FollowController@store2', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            <input type="hidden" name="followpostid" value="{{$user->id}}">
                            <button type="submit" class="follow-btn42">
                                <i class="fal fa-plus"></i> <a>Follow</a> 
                            </button>
                            {!! Form::close() !!}
                            @endif
                            @endif
                            
                        </div>
                        <!-- /follow -->

                        <!-- follwers/following login user -->
                        <div class="col-12">
                            <div class="row">

                            @php $followers = 0 @endphp
                            @php $following = 0 @endphp
                            @if(count($follows) > 0)
                            @foreach($follows as $f)
                            @if($f->followUserId == $user->id)
                                @php $following++ @endphp
                            @endif
                            @if($f->followedUserId == $user->id)
                                @php $followers++ @endphp
                            @endif
                            @endforeach
                            @endif

                                <div class="col-6 followers_con_log">
                                    @if($user->id == Auth::user()->id)
                                    <button class="followers_btn_log">
                                        {{number_format($followers)}}
                                        <div class="col small" style="">Followers</div>
                                    </button>
                                    @endif
                                </div>

                                <div class="col-6 following_con_log" >
                                    @if($user->id == Auth::user()->id)
                                    <button class="following_btn_log">
                                        {{number_format($following)}}
                                        <div class="col small" style="">Following</div>
                                    </button>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <!-- follwers/following login user end -->
                    </div>
                </div>
            </div>

            <div class="three-dots-big42">
                <div class="dropdown dots42">
                    <button class="btn tdots42" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter1">
                        <i class="fal fa-ellipsis-v fa-2x"></i>
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="height:auto;">

                                    @if(Auth::user()->id != $user->id && $user->accountVerified != "BANNED")
                                    <!-- user report -->
                                    <button class="btn btn2" style="width:100%;text-align:left;" type="button" onclick="reportFunction2()">Report User</button>
                                    <form action="{{route('report')}}" method="GET">
                                    <input type="hidden" name="userid" value="{{$user->id}}">
                                    <input type="hidden" name="postid" value="">
                                    <input type="hidden" name="commentid" value="">
                                    <div class="row" id="reportDiv2" style="display:none;">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reportDescription" id="exampleRadios1-{{$user->id}}" value="Inappropriate" onclick="document.getElementById('custom-{{$user->id}}').disabled = true">
                                                <label class="form-check-label" for="exampleRadios1-{{$user->id}}">
                                                Inappropriate
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reportDescription" id="exampleRadios2-{{$user->id}}" value="Scam" onclick="document.getElementById('custom-{{$user->id}}').disabled = true">
                                                <label class="form-check-label" for="exampleRadios2-{{$user->id}}">
                                                Scam
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reportDescription" id="exampleRadios3-{{$user->id}}" value="False Information" onclick="document.getElementById('custom-{{$user->id}}').disabled = true">
                                                <label class="form-check-label" for="exampleRadios3-{{$user->id}}">
                                                False Information
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reportDescription" id="exampleRadios4-{{$user->id}}" value="Vulgar" onclick="document.getElementById('custom-{{$user->id}}').disabled = true">
                                                <label class="form-check-label" for="exampleRadios4-{{$user->id}}">
                                                Vulgar
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reportDescription" id="exampleRadios6-{{$user->id}}" value="Vulgar" onclick="document.getElementById('custom-{{$user->id}}').disabled = false">
                                                <label class="form-check-label" for="exampleRadios6-{{$user->id}}" style="width:400px;">
                                                Other: <small>(Please tell us, so we can understand.)</small> 
                                                </label>
                                                <textarea type="text" name="reportDescription" id="custom-{{$user->id}}" placeholder="" style="width:400px;height:100px;" required disabled></textarea>
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
                                    <!-- /user report -->
                                    @endif
                                    

                                    @if(Auth::user()->id == $user->id && $user->accountVerified == "NOT VERIFIED" && $user->accountType == "RECEPIENT")
                                    <!-- request verification -->
                                    <button class="btn btn2" style="width:100%;text-align:left;" type="button" onclick="verificationFunction()">Request Account Verification</button>
                                    <div class="row deleteDiv2" id="verificationDiv" style="display:none; ">
                                        <div class="row">

                                            
                                            {!! Form::open(['action' => 'App\Http\Controllers\UsersController@request_verification', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                                <div class="form-group" style="margin-top:20px;">
                                                <label for="edit_post" style="background:#dbdcdd;padding:10px 10px 10px 20px;border-radius:5px;width:100%;">
                                                Request for account verification: <br><br>

                                                What is account verification? <br><br>

                                                Account verification is the process of verifying that a new or existing account is owned and operated by a specified real individual or organization.<br><br>

                                                How can we determine if an account is verified?<br><br>

                                                It is when you see a check icon<i class="fa fa-check-circle verified-icon" aria-hidden="true" style=""></i> &nbsp; near the name of the account in their profile page. <br><br>
                                                </label>

                                                <div class="col-sm-12" style="">
                                                        <div class="" style="position:relative;">
                                                            <div class="form-group" style="">
                                                                <label class="modal_row_title" style="">Do you wish to send verification request? You may, by sending us a clear scan copy image file of your identification (Valid ID) / certificate that shows your registered certificate no. / accreditation no., then, wait within 30 working days to process your request.</label>
                                                                <div class="input-group" style="">
                                                                    <span class="input-group-btn">
                                                                        <span class="btn btn-default btn-file" style="">
                                                                            Add Image<input type="file" id="imgInp" name="user_id">
                                                                        </span>
                                                                    </span>
                                                                    <input  type="text" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="col-sm-12" style="">
                                                    <small style="padding-left:10px;">Please make sure that your image is clear and readable.</small>
                                                    <img id='img-upload'/>
                                                </div>
                                                
                                                </div>

                                                <div class="col-sm-12" style="position:relative;width:100%;margin-left:0px;">
                                                    <div class="">
                                                        <button type="submit" class="btn-delete-yes">Submit</button>

                                                        <button class="btn-delete-no" type="button" class="close" data-dismiss="modal" aria-label="Close" style="width:100px;float:right;margin-bottom:20px;">Cancel</button>
                                                    </div>
                                                </div>

                                            {!! Form::close() !!}
                                        </div>
                                        
                                    </div>
                                    <!--/request verification -->
                                    @endif

                                    @if(Auth::user()->id == $user->id)
                                    <!-- request deletion -->
                                    <button class="btn btn2" style="width:100%;text-align:left;" type="button" onclick="deletionFunction()">Request Account Deletion</button>
                                    <div class="row deleteDiv2" id="deletionDiv" style="display:none; ">
                                    <br>
                                        <div class="row" style="margin-top:20px;">
                                            <div class="col" style="background:#dbdcdd;padding:20px;border-radius:10px;">
                                            <p>
                                                Request Account Deletion: <br><br>
                                                Upon proceeding, please wait within 30 working days to process your request. You cannot undo this action once the admins accepted your request. <br><br><br>

                                                Thank you.
                                            </p>
                                            </div>
                                        </div>

                                        <div class="row" style="display:flex;">
                                            <form action="{{route('request_deletion')}}" method="GET">
                                            <div class="" style="position:relative;width:50%;margin-left:50px;">
                                                <div class="">
                                                    <button type="submit" class="btn-delete-yes">Proceed</button>
                                                </div>
                                            </div>  
                                            </form>

                                            <div class="" style="position:absolute;width:50%;margin-left:250px;">
                                                <div class="">
                                                    <button class="btn-delete-no" type="button" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
                                                </div>
                                            </div>    

                                        </div>
                                    </div>
                                    <!-- /request deletion -->
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /modal -->

                    <!-- customer support on big screen -->
                    @if($user->id == Auth::user()->id)
                    <div class="row icon-message-con">
                        <button class="btn-icon-message-big tdots42" data-toggle="modal" data-target="#exampleModalCenterMessage">
                            <i class="fas fa-user-headset fa-lg"></i>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenterMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Customer Support</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body ">
                                    <div class="row message-content">
                                        <div class="col">
                                        @if(count($vars) > 0)
                                        @foreach($vars as $var)
                                        @if($var->inquirySentToId == Auth::user()->id)
                                            <div class="row admin-message" >
                                                <div class="col-2">
                                                    <img src="/storage/profile_images/admin.jpg" class="img-msg-user" alt="">
                                                </div>
                                                <div class="col-10 admin-msg-con1">
                                                    <div class="col info-msg-user">
                                                        <small class="admin-msg-name">Admin</small>
                                                        <small class="admin-msg-time">{{date('F j, Y h:i A', strtotime($var->inquiryCreatedAt))}}</small>
                                                    </div>
                                                    
                                                    <div class="w-100"></div>
                                                    <label>{{$var->inquiryMessage}}</label>
                                                </div>
                                            </div>
                                            @endif

                                            @if($var->inquiryUserId == Auth::user()->id)
                                            <div class="row user-message">
                                                <div class="col-10 user-msg-con1">
                                                        
                                                    <div class="info-msg-user">
                                                        <small class="user-msg-name">You</small>
                                                        <small class="user-msg-time">{{date('F j, Y h:i A', strtotime($var->inquiryCreatedAt))}}</small>
                                                    </div>
                                                    <div class="w-100"></div>

                                                        <label >{{$var->inquiryMessage}}</label>             
                                                </div>
                                                <div class="col-2">
                                                    <img src="/storage/profile_images/{{Auth::user()->profileImage}}" class="img-msg-user" alt="">
                                                </div>
                                            </div>
                                            @endif

                                            @endforeach
                                            @endif

                                        </div>
                                    </div>

                                    <form class="msger-inputarea" action="{{route('inquiryToAdmin')}}" method="GET">
                                    <div class="row type-row">
                                    
                                        <input type="hidden" name="receiverid" value="1">
                                        <div class="col-9 message-type">
                                            <textarea type="text" name="inquirymessage" rows="3" class="message-input" placeholder="Ask your question..."></textarea>
                                        </div>
                                        <div class="col-3 btn-msg-con" >
                                            <button type="submit" class="btn-msg-submit">
                                                <i class="fas fa-paper-plane" style="position:relative;color:white;">
                                                Send</i>
                                            </button>
                                        </div>
                                    
                                    </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                    @endif
                    </div>
                    <!-- /customer support on big screen -->
                </div> 
            </div>
            <!-- /3 dots -->
    </div>
</div>

    <div class="row allpost_con">
        <div class="row allpost_area" >
            <div class="col-4 left_panel_main_con" >
                <div class="container left_panel_normal" id="shopping-cart">
                    <div class="row left_row_header">
                        Intro
                    </div>
                    <!--  -->
                    @if($user->orgName == NULL)
                    <div class="row left_row_birthday">
                        <div class="col-2">
                            <i class="fal fa-birthday-cake"></i>
                        </div>
                        <div class="col-9">
                            <a href="">{{date('F j, Y', strtotime($user->birthday))}}</a>
                        </div>
                    </div>
                    @endif
                    <!--  -->
                    <div class="row left_row_birthday">
                        <div class="col-2">
                            <i class="fal fa-map-marker-alt"></i>
                        </div>
                        <div class="col-9">
                            <a href="">Lives in {{$user->city.", ".$user->province}}</a>
                        </div>
                    </div>
                    <!--  -->
                    @if($user->id != Auth::user()->id)
                    <!-- donor create post -->
                    <!-- <button class="center_create_btn" data-toggle="modal" data-target=".bd-example-modaldonor-lg">
                        Click here to ask help from {{$user->orgName}}..
                    </button> -->
                    <!-- donor create post end -->
                    <!-- donor create post -->
                    <!-- <a href="/users/profile2/{{$user->id}}"><button class="center_create_btn">
                        View your posts from this page..
                    </button></a> -->
                    <!-- donor create post end -->
                    @else
                    <!-- donor create post -->
                    <!-- <a href="/users/profile2/{{$user->id}}"><button class="center_create_btn">
                        View posts from others..
                    </button></a> -->
                    <!-- donor create post end -->
                    @endif
                    <!--  -->
                    <div class="row left_row_header">
                        Recent Follower
                    </div>
                    <!--  -->
                    
                    @if(count($follows) > 0)
                    @foreach($follows as $follow)
                    @if($follow->followedUserId == $user->id)
                    <div class="row left_recent_follow">
                        
                        <div class="col-3">
                            <img src="/storage/profile_images/{{$follow->profileImage}}" class="left_recent_pic" alt="">
                        </div>
                        <div class="col-8">
                        <a href="{{$follow->followUserId}}" style="color:black;">{{$follow->firstName." ".$follow->middleName." ".$follow->lastName." ".$follow->orgName}}</a>
                        </div>
                        
                    </div>
                    @endif
                    @endforeach
                    @endif
                </div>
            </div>
            <!-- center and post area -->
            <div class="col" style="width:1040px;">
                <div class="container center_post_area" >

                    @if($user->id == Auth::user()->id && Auth::user()->accountType == "RECEPIENT")
                    <!-- create post container start -->
                    <div class="row center_create_con" >
                    @include('inc.messages')
                        <div class="col-2">
                            <img src="/storage/profile_images/{{$user->profileImage}}" class="center_user_pic" alt="">
                        </div>
                        <div class="col-9">
                            <button class="center_create_btn" data-toggle="modal" data-target=".bd-example-modal-lg">
                                Create post...
                            </button>
                        </div>
                    </div>   
                    <!-- create post end -->
                    @elseif($user->id != Auth::user()->id)
                    <div class="row " style="">
                        @include('inc.messages')
                    </div>   
                    @endif
                    
                    
                    <!-- RECEPIENT VIEW POSTS -->
                    <div id="recepientpost" style="margin-top:10px;">
                    @if(count($posts) > 0)
<!--post -->        @foreach($posts as $post)

                    @if($post->postUser2Id == NULL)
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
                                    <div class="modal-body" style="height:auto;">

                                        @if(Auth::user()->id != $post->postUserId)
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
                <!-- end of first row -->
                
                <!-- second row (post caption) -->
                <div class="row post_caption_con" style="display:flex;">
                   <h4 style="text-decoration:underline;">{{$post->postCategory}}</h4>
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
                            <button class="post_donate_button" style="font-size:17px;">Stop Accepting Donation</button>
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
                                        <input type="hidden" name="previous_url" value="users/profile/{{$user->id}}">
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
                    @endif

                    @endforeach
                    @else
                    @endif

                    
                </div>
            </div>
            <!-- end of post area -->
            </div>
            <!-- //RECEPIENT POSTS END -->

            
        </div>
    </div>

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

            {!! Form::open(['action' => 'App\Http\Controllers\PostsController@storeFromTimeline', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="modal-body">   
                    <div class="col-sm-12" style="display:flex;">
                            <div class="row modal_row_title" style="width:200px;position:relative;">Title of your Post: <small style="">(Ex: Fire in Mandaue City)</small></div>
                            <div class="row modal_input_amount" style="width:100%;margin-left:20px;">
                                <input type="text" name="category" id="" >
                            </div>
                    </div> <br>
                    <div class="row post_textarea_row">
                        <textarea name="caption" id="" cols="30" rows="7" class="modal_post_textarea" placeholder="Write a description..."></textarea>
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
                        <div class="row modal_row_title_dark">Please fill out neccesary information..</div> <br>
                        
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
<!-- create post modal -->


<!-- create post modal 2 -->
<div class="modal fade bd-example-modaldonor-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ask help: Create Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {!! Form::open(['action' => 'App\Http\Controllers\PostsController@storeFromTimeline2', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <input type="hidden" name="owneruserid" id="" value="{{$user->id}}">
                <div class="modal-body">   
                    <div class="col-sm-12" style="display:flex;">
                            <div class="row modal_row_title" style="width:200px;position:relative;">Title of your Post: <small style="">(Ex: Fire in Mandaue City)</small></div>
                            <div class="row modal_input_amount" style="width:100%;margin-left:20px;">
                                <input type="text" name="category" id="" >
                            </div>
                    </div> <br>
                    <div class="row post_textarea_row">
                        <textarea name="caption" id="" cols="30" rows="7" class="modal_post_textarea" placeholder="Write a description..."></textarea>
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
                        <div class="row modal_row_title_dark">Please fill out neccesary information..</div> <br>
                        
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
<!-- create post modal 2 end -->



<script>
function reportFunction2() {
  var x = document.getElementById("reportDiv2");
  if (x.style.display === "none") {
    x.style.display = "inline";
  } else {
    x.style.display = "none";
  }
}
</script>

<script>
function verificationFunction() {
  var x = document.getElementById("verificationDiv");
  var y = document.getElementById("deletionDiv");
  if (x.style.display === "none") {
    x.style.display = "inline";
    y.style.display = "none";
  } else {
    x.style.display = "none";
  }
}
</script>

<script>
function deletionFunction() {
  var x = document.getElementById("deletionDiv");
  var y = document.getElementById("verificationDiv");
  if (x.style.display === "none") {
    x.style.display = "inline";
    y.style.display = "none";
  }else {
    x.style.display = "none";
  }
}
</script>


@endsection