<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../style/admin_style2.css" rel="stylesheet" type="text/css" >
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="../../style/admin_tabs2.css" rel="stylesheet" type="text/css" >
    <link href="../../style/admin_postinfo_modal.css" rel="stylesheet" type="text/css" >
    <link rel="shortcut icon" href="{{ asset('images/wecarelogo.png') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>WeCare Admin</title>
</head>
<body>
@php date_default_timezone_set("Asia/Manila"); @endphp
    <div class="row parent_con h-100">
        <div class="col-3 small_con">
            <div class="row banner_header"> <!-- this is banner area -->
                <div class="row">
                    <img src="../../images/wecarebanner admin.png" alt="" class="img_banner">
                </div>
                
                <div class="row admin_profile_info">
                    <div class="col-4">
                        <img src="/storage/profile_images/{{Auth::user()->profileImage}}" alt="" class="profile_img">
                    </div>
                    <div class="col-8">
                        <label for="" class="admin_name">Hi, {{Auth::user()->firstName." ".Auth::user()->middleName." ".Auth::user()->lastName." ".Auth::user()->orgName}}</label>
                        <br>
                        <small class="admin_title">ADMIN</small>
                    </div>
                </div>
            </div> <!-- end banner area -->

            <div class="row tile_area">
                <div class="container tile_con">

                    


                    @foreach($tiles as $tile)
                    <form action="{{ route($tile) }}" method="GET">
                    <input type="hidden" name="selected_tile" value="{{$tile}}">
                    @csrf
                    <div class="row"> <!-- active or selected tile  -->
                    @if($tile == $selected_tile)
                        <button type="submit" class="active_tile">
                    @else
                        <button type="submit" class="normal_tile">
                    @endif
                            <div class="row">
                                <div class="col-8">{{$tile}}</div>
                                @php $num = 0; @endphp
                                @if($tile == 'Donors')
                                    @if(count($layoutpeople) > 0)
                                    @foreach($layoutpeople as $var)
                                        @if($var->accountVerified == "NOT VERIFIED")
                                            @php $num = 1; @endphp
                                        @endif
                                    @endforeach
                                    @if($num == 1)
                                        <div class="col-4">
                                            <div class="circle_alert"></div> <!-- this circle is for the alert -->
                                        </div>
                                    @endif
                                    @endif
                                @endif
                                @if($tile == 'Recepients')
                                @if(count($layoutorg) > 0)
                                    @foreach($layoutorg as $var)
                                        @if($var->accountVerified == "NOT VERIFIED")
                                            @php $num = 2; @endphp
                                        @endif
                                    @endforeach
                                    @if($num == 2)
                                        <div class="col-4">
                                            <div class="circle_alert"></div> <!-- this circle is for the alert -->
                                        </div>
                                    @endif
                                    @endif
                                @endif
                                @if($tile == 'Posts')
                                    @if(count($layoutpost) > 0)
                                    @foreach($layoutpost as $var)
                                        @if($var->postStatus == "PROCESS")
                                            @php $num = 3; @endphp
                                        @endif
                                    @endforeach
                                    @if($num == 3)
                                        <div class="col-4">
                                            <div class="circle_alert"></div> <!-- this circle is for the alert -->
                                        </div>
                                    @endif
                                    @endif
                                @endif
                                @if($tile == 'Users Inquiries')
                                    @if(count($layoutinquiry) > 0)
                                    @foreach($layoutinquiry as $var)
                                        @if($var->inquiryStatus == "UNREAD")
                                            @php $num = 4; @endphp
                                        @endif
                                    @endforeach
                                    @if($num == 4)
                                        <div class="col-4">
                                            <div class="circle_alert"></div> <!-- this circle is for the alert -->
                                        </div>
                                    @endif
                                    @endif
                                @endif
                                @if($tile == 'Reports')
                                    @if(count($layoutreport) > 0)
                                    @foreach($layoutreport as $var)
                                        @if($var->reportStatus == "PROCESS")
                                            @php $num = 5; @endphp
                                        @endif
                                    @endforeach
                                    @if($num == 5)
                                        <div class="col-4">
                                            <div class="circle_alert"></div> <!-- this circle is for the alert -->
                                        </div>
                                    @endif
                                    @endif
                                @endif
                                @if($tile == 'Requests')
                                    @if(count($layoutrequest) > 0)
                                    @foreach($layoutrequest as $var)
                                        @if($var->reviewStatus == "PROCESS")
                                            @php $num = 6; @endphp
                                        @endif
                                    @endforeach
                                    @if($num == 6)
                                        <div class="col-4">
                                            <div class="circle_alert"></div> <!-- this circle is for the alert -->
                                        </div>
                                    @endif
                                    @endif
                                @endif
                            </div>
                        </button>
                    </div> <!-- end of tile -->

                    </form>
                    @endforeach
                    <form action="{{ route('logout') }}" method="POST">@csrf
                    <div class="row"> 
                        <button type="submit" class="normal_tile">
                            <div class="row">
                                <div class="col-8">Logout</div>
                                <div class="col-4">
                                    <div class="circle_alert" style="display:none;"></div> <!-- this circle is for the alert -->
                                </div>
                            </div>
                        </button>
                    </div> <!-- end of tile -->
                    </form>
                      

                </div>
            </div>
        </div>



<!-- big container (this is for the content) -->
<div class="col-9 big_con">
    <div class="big_main_con">
        
        <!-- topbar here -->
        <form action="{{ route('Posts') }}" method="GET">
        <div class="row top_search_area" >
            <div class="col-7" style="margin-top:10px !important; ">
                <div class="input-group mb-3">
                    <input type="hidden" name="selected_tile" value="Posts">
                    <input class="form-control" type="search" placeholder="Search" name="search" onclick="submit_form()" aria-label="Search" value="{{ $search }}" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" style="height:40px;;margin-top:-1px;">Search</button>
                    </div>
                </div>
            </div>
            <div class="col-4" style="margin-top:8px; margin-left:80px;">
                <img src="/storage/profile_images/{{Auth::user()->profileImage}}" alt="" class="profile_img_top">
            </div>
        </div>
        </form>
        <!-- /topbar here -->

        <!-- body here -->
        <div class="row inner_main_con">
            <div class="container tab_outer_con">
                <div class="row">
                    <div class="col-12">
                        <label for="" class="title_con">Posts Records</label>
                    </div>
                </div>
                <div class="row">
                @if(count($vars) > 0)
                <div class="col-9">
                    <label for="" class="title_con">
                    Items:
                    @foreach($vars as $count=>$var)
                    @endforeach
                    {{$count+=1}}
                    </label>
                </div>
                @else
                <div class="col-9">
                    <label for="" class="title_con">
                    Items: 0
                    </label>
                </div>
                @endif
                <div class="col-3">
                    <form action="{{ route('admin_posts_pdf') }}" method="GET">
                        <input type="hidden" name="search1" value="{{$search}}">
                        <button type="submit" style="border:none;background:none;color:white;"><i class="fa fa-download" aria-hidden="true"></i> Export to PDF</button>
                    </form>
                </div>
                </div>
                <div class="row tab_body_row" >
                <div class="container tab_body_con" >
                    <div class="row" >
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Post ID</th>
                                <th scope="col">Posted By</th>
                                <th scope="col">Target Amount</th>
                                <th scope="col">Received Amount</th>
                                <th scope="col" class="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $cnt=0; @endphp
                        @if(count($vars) > 0)
                        @foreach($vars as $var)
                            <tr>
                                <td>@php echo $cnt+=1; @endphp</td>
                                <td>{{$var->postId}}</td>
                                <td>{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</td>
                                <td>PHP {{number_format($var->postTargetAmount, 2)}}</td>
                                <td>PHP {{number_format($var->postReceivedAmount, 2)}}</td>
                                
                                <td class="center">
                                    <button class="btn_view" type="button" data-toggle="modal" data-target=".bd-example-modal-lg-{{$var->postId}}">View</button>
                                    <button class="btn_delete" data-toggle="modal" data-target=".bd-example-modal-sm-{{$var->postId}}">Delete</button>
                                </td>
                                </td>
                                
                            </tr>

                            <!-- view modal222 -->
                            <div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">User Information</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                                <div class="col">
                                                <img style="width: 100%; height: 100%;" src="/storage/cover_images/{{$var->postCoverImage}}" alt="" class="">
                                                </div>
                                                <div class="col" style="width:290px;">
                                                <label for="">Posted By: <h5>{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</h5></label><br>
                                                <label for="">Caption: <h6>{{$var->postCaption}}</h6></label><br>
                                                @php $com2 = 0 @endphp
                                                @if(count($comments) > 0)
                                                @foreach($comments as $comment)
                                                    @if($var->postId == $comment->commentPostId)
                                                        @php $com2++ @endphp
                                                    @endif
                                                    
                                                @endforeach
                                                <label for="">Number of Comments: <h6>{{$com2}}</h6></label><br>
                                                @else
                                                <label for="">Number of Comments: <h6>{{$com2}}</h6></label><br>
                                                @endif

                                                <label for="">Date Posted: <h6>{{date('F j, Y', strtotime($var->postCreatedAt))}}</h6></label><br>
                                                
                                                <label for="">Location: <h6>{{$var->postSector.", ".$var->postBarangay.", ".$var->postCity.", ".$var->postProvince.", ".$var->postRegion}}</h6></label><br>
                                                
                                                <label for="">Target Amount: <h6>Php {{number_format((float)$var->postTargetAmount, 2, '.', '')}}</h6></label><br>
                                                <label for="">Received Amount: <h6>Php {{number_format((float)$var->postReceivedAmount, 2, '.', '')}}</h6></label><br>
                                                </div>
                                                
                                                <input type="hidden" name="recepient" value="{{$var->id}}">
                                        </div>

                                        <div class="modal-footer">

                                            @if($var->postStatus == "VERIFIED")
                                              <button type="submit" class="btn btn-primary" style="background-color:green; color:white;" disabled><i class="fa fa-check" aria-hidden="true"></i> Post Verified</button>
                                            @else
                                            <form action="{{ route('admin_verify_post') }}" method="GET">
                                                <input type="hidden" name="userid" value="{{$var->id}}">
                                              <input type="hidden" name="postid" value="{{$var->postId}}">
                                              <button type="submit" class="btn btn-primary">Verify this Post</button>
                                            </form>
                                            @endif
                                            <button type="button" class="btn btn-secondary second_btn" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end of review modal222 -->

                            

                            <!-- delete modal -->
                            <div class="modal fade bd-example-modal-sm-{{$var->postId}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Account Deletion</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            Are you sure you want to delete this post? Please note that you cannot undo this after.
                                        </div>

                                        <div class="modal-footer">
                                            <form action="{{route('admin_delete')}}" method="GET">
                                            <input type="hidden" name="deletePost" value="{{$var->postId}}">
                                            <button type="submit" class="btn btn-primary primary_btn">Yes</button>
                                            </form>
                                            
                                            <button type="button" class="btn btn-secondary second_btn" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end of delete modal -->
                        @endforeach
                
                        @else
                        <tr>
                            <td colspan="11" style="text-align:center">No Record.</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
            </div>
            </div>
        <!-- /body here -->
    </div>
</div>
<!-- /big container (this is for the content) -->

@if(count($vars) > 0)
@foreach($vars as $var)
<!-- review modal -->
<div class="modal fade bd-example-modal-lg-{{$var->postId}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Post Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home-{{$var->postId}}" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Post Information</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile-{{$var->postId}}" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Donation Information</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-toggle="pill" data-target="#pills-contact-{{$var->postId}}" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Comment Information</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-toggle="pill" data-target="#pills-distribution-{{$var->postId}}" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Distribution</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-toggle="pill" data-target="#pills-files-{{$var->postId}}" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Attached Files</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home-{{$var->postId}}" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="container">
                        <div class="row post_info_row">
                            <div class="col-2 col_post_head">
                                Post ID:
                            </div>
                            <div class="col-10 col_post_info">
                                {{$var->postId}}
                            </div>
                        </div>
                        <div class="row post_info_row">
                            <div class="col-2 col_post_head">
                                Date Posted:
                            </div>
                            <div class="col-10 col_post_info">
                            {{date('F j, Y', strtotime($var->postCreatedAt))}}
                            </div>
                        </div>
                        <div class="row post_info_row">
                            <div class="col-2 col_post_head">
                                Post Owner:
                            </div>
                            <div class="col-10 col_post_info">
                            {{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}
                            </div>
                        </div>
                        <div class="row post_info_row">
                            <div class="col-2 col_post_head">
                                City:
                            </div>
                            <div class="col-10 col_post_info">
                            {{$var->postCity}}
                            </div>
                        </div>
                        <div class="row post_info_row">
                            <div class="col col_post_head">
                                Post Images:
                            </div>
                        </div>
                        <div class="row col_post_info">
                            <img src="/storage/cover_images/{{$var->postImageName}}" alt="" class="post_info_pics">
                        </div>
                        <div class="row post_info_row">
                            <div class="col-12 col_post_head">
                                Post caption:
                            </div>
                            <div class="col-12 col_post_info">
                            {{$var->postCaption}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-profile-{{$var->postId}}" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="container">
                        <div class="row row_total_info">
                            <div class="col-3">
                                <span class="item_bold">Total Items:</span>
                                @php $tcnt = 0; @endphp
                                @if(count($transactions) > 0)
                                @foreach($transactions as $t)
                                    @if($t->recactivityPostId == $var->postId)
                                    @php $tcnt += 1; @endphp
                                    @endif
                                @endforeach
                                @endif
                                <span class="item_info">{{$tcnt}}</span>
                            </div>
                            <div class="col-4">
                                <span class="item_bold">Target Amount:</span><span class="item_info">PHP {{number_format($var->postTargetAmount,2)}}</span>
                            </div>
                            <div class="col-5">
                                <span class="item_bold">Amount Acquired:</span><span class="item_info">PHP {{number_format($var->postReceivedAmount,2)}}</span>
                            </div>
                        </div>
                    </div>
                    
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Amount Donated</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $tcnt2 = 0; $v=0; @endphp
                            @if(count($transactions) > 0)
                            @foreach($transactions as $t)
                            @if($t->recactivityPostId == $var->postId)
                            <tr>
                                
                                <th scope="row">{{$tcnt2+=1}}</th>
                                <td>{{$t->firstName." ".$t->middleName." ".$t->lastName." ".$t->orgName}}</td>
                                <td>{{number_format($t->recactivityAmount,2)}}</td>
                                <td>{{date('F j, Y', strtotime($t->recactivityCreatedAt))}}</td>
                                
                            </tr>
                            @endif

                            @endforeach
                            @if($tcnt2 == 0)
                            <tr>
                                <th colspan="4" style="text-align:center;">No record</td>
                            </tr>
                            @endif
                            @else
                            <tr>
                                <th colspan="4" style="text-align:center;">No record</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="pills-contact-{{$var->postId}}" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="container">
                        <div class="row row_total_info" >
                            <div class="col-4">
                                <span class="item_bold">Total Items:</span>
                                @php $ccnt = 0; @endphp
                                @if(count($comments) > 0)
                                @foreach($comments as $t)
                                @if($t->commentPostId == $var->postId)
                                    @php $ccnt += 1; @endphp
                                @endif
                                @endforeach
                                @endif
                                <span class="item_info">{{$ccnt}}</span>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $ccnt2 = 0; @endphp
                            @if(count($comments) > 0)
                            @foreach($comments as $c)
                            @if($c->commentPostId == $var->postId)
                            <tr>
                                <th scope="row">{{$ccnt2+=1}}</th>
                                <td>{{$c->firstName." ".$c->middleName." ".$c->lastName." ".$c->orgName}}</td>
                                <td>{{date('F j, Y', strtotime($c->commentCreatedAt))}}</td>
                                <td>{{$c->commentDescription}}</td>
                            </tr>
                            @endif

                            @endforeach
                            @if($ccnt2 == 0)
                            <tr>
                                <th colspan="4" style="text-align:center;">No record</td>
                            </tr>
                            @endif
                            @else
                            <tr>
                                <th colspan="4" style="text-align:center;">No record</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="pills-distribution-{{$var->postId}}" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="container">
                        <div class="row row_total_info" >
                            <div class="col-4">
                                <span class="item_bold">Total Items:</span>
                                @php $ccnt = 0; @endphp
                                @if(count($transparency) > 0)
                                @foreach($transparency as $i=>$tran)
                                @if($tran->transparencyPostId == $var->postId)
                                    @php $ccnt += 1; @endphp
                                @endif
                                @endforeach
                                @endif
                                <span class="item_info">{{$ccnt}}</span>
                            </div>
                        </div>
                    </div>
                                    @php $total1 = 0; $total2 = 0; @endphp
                                    @if(count($transparency) > 0)
                                    @foreach($transparency as $i=>$tran)
                                    @if($tran->transparencyPostId == $var->postId)
                                        @php $total1 += $tran->transparencyAmount; @endphp
                                        @php $total2 += $tran->transparencyAmount; @endphp
                                    @endif
                                    @endforeach
                                    @endif
                                    <div style="text-align:right;font-weight:bold;display:flex;float:right;">
                                    (Grand Total) Donations: PHP {{number_format($var->postReceivedAmount,2)}} |  Distributions: PHP {{number_format($total1,2)}} | Remaining: @php $remains = $var->postReceivedAmount - $total1; @endphp @if($remains < 0) <div style="color:red;">&nbsp;{{number_format($remains,2)}}</div> @else {{number_format($remains,2)}} @endif
                                    </div><br>

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Person-in-Charge</th>
                                <th scope="col">Barangay</th>
                                <th scope="col">Name/Recepient</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                                        @if(count($transparency) > 0)
                                        @foreach($transparency as $i=>$tran)
                                        @if($tran->transparencyPostId == $var->postId)
                                        <tr>
                                            <td>{{date('F j, Y',strtotime($tran->transparencyCreatedAt))}}</td>
                                            <td>{{$tran->firstName." ".$tran->middleName." ".$tran->lastName." ".$tran->orgName}}</td>
                                            <td>{{$tran->transparencyLocation}}</td>

                                            @if(count($transparency2) > 0)
                                            @foreach($transparency2 as $i=>$tran2)
                                            @if($tran2->transparencyPostId == $var->postId && $tran->transparencyId == $tran2->transparencyId)
                                            <td>{{$tran2->firstName." ".$tran2->middleName." ".$tran2->lastName." ".$tran2->orgName}}</td>
                                            @endif
                                            @endforeach
                                            @endif

                                            <td>PHP {{number_format($tran->transparencyAmount,2)}}</td>
                                            
                                        </tr>
                                        @endif
                                        @endforeach
                                        <tr style="border-top:2px solid black;">
                                        
                                            <td colspan="4">Total</td>
                                            <td>PHP {{number_format($total2,2)}}</td>
                                        </tr>
                                        @endif
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="pills-files-{{$var->postId}}" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="container">
                        <div class="row row_total_info" >
                            <div class="col-4">
                                <span class="item_bold">Total Items:</span>
                                @php $ccnt = 0; @endphp
                                @if(count($files) > 0)
                                @foreach($files as $file)
                                @if($file->filePostId == $var->postId)
                                    @php $ccnt += 1; @endphp
                                @endif
                                @endforeach
                                @endif
                                <span class="item_info">{{$ccnt}}</span>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <tr>
                            <th colspan="2">Files Available:</th>
                            <th>Uploaded by:</th>
                        </tr>
                        @if(count($files) > 0)
                        @foreach($files as $file)
                        @if($file->filePostId == $var->postId)
                        <tr>
                            <td>{{date('Y-m-d | h:i A', strtotime($file->fileCreatedAt))}}</td>
                            <td><form action="/download"><input type="hidden" name="filename" id="" value="{{$file->filePath}}"><button type="submit" style="background:none;border:none;">{{$file->fileName}}</button></form></td>
                            <td>{{$file->firstName." ".$file->middleName." ".$file->lastName." ".$file->orgName}}</td>
                        </tr>
                        @endif
                        @endforeach
                        @else
                        <tr>
                            <td colspan="3">No File</td>
                        </tr>
                        @endif
                    </table>
                </div>

            </div>
        </div>

        <div class="modal-footer">
            @if($var->postStatus == "VERIFIED")
                <button type="submit" class="btn btn-primary" style="background-color:green; color:white;" disabled><i class="fa fa-check" aria-hidden="true"></i> Post Verified</button>
            @elseif($var->postStatus == "BANNED")
                <button type="submit" class="btn btn-primary" disabled><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size:14px"></i> This Post is Banned</button>
            @else
            <!-- <form action="{{ route('admin_verify_post') }}" method="GET">
                <input type="hidden" name="userid" value="{{$var->id}}">
                <input type="hidden" name="postid" value="{{$var->postId}}">
                <button type="submit" class="btn btn-primary">Verify this Post</button>
            </form> -->
            @endif
            <button type="button" class="btn btn-secondary second_btn" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>
<!-- end of review modal -->
@endforeach
@endif

    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!--/jquery-->

    <!--Javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <!--/script-->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- custom scrollbar plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
}
document.getElementById("datetime").innerHTML =formatAMPM(new Date);
</script>
</body>
</html>