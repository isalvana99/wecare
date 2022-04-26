<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="../../style/admin_style.css" rel="stylesheet" type="text/css" >
    <link href="../../style/admin_message2.css" rel="stylesheet" type="text/css" >
    <link href="../../style/admindash.css" rel="stylesheet" type="text/css" >
    <link href="../../style/admin_tabs.css" rel="stylesheet" type="text/css" >
    <link href="../../style/admin_tabs_user.css" rel="stylesheet" type="text/css" >
    <link href="../../style/admin_tabs_comment.css" rel="stylesheet" type="text/css" >
    <link href="../../style/admin_tabs_post.css" rel="stylesheet" type="text/css" >
    <link href="../../style/admin_leaderboards.css" rel="stylesheet" type="text/css" >
    <link href="../../style/admin_new_dashboard.css" rel="stylesheet" type="text/css" >
    <link href="../../style/admin_userinfo_modal.css" rel="stylesheet" type="text/css" >
    <link rel="shortcut icon" href="{{ asset('images/wecarelogo.png') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <title>WeCare Admin</title>
</head>
<style>
    .grid-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }
    .con-stats{
        background-color: #5b609e;
        border:2px solid #3c4077;
        border-radius: 10px;
        height: 510px;
        width: 1500px;
    }
    .con-stats2 {
        margin: 10px 0 0 0;
        height: 485px !important;
        width:970px;
        overflow: hidden;
        overflow-y: scroll;
    }
    .stats-title {
        background: white;
        color: black;
    }
    #top_admin_logout2{
    float: right !important;
    background-color: rgba(255, 255, 255, 0) !important;
    border: none !important;
    color: white !important;
    margin: 5px !important;
    padding: 5px !important;
    border-radius: 5px !important;
    border:1px solid #ffffff00 !important;
    }

    #top_admin_logout2:hover{
        background-color: rgba(255, 255, 255, 0.158) !important;
        border: none !important;
        color: white !important;
        margin: 5px !important;
        border:1px solid #ffffff67 !important;
    }

    #top_admin_logout2 i{
        margin-left: 10px !important;
    }
    .top_search_area2{
        background-color: #3c4077;
        padding: 10px;
    }
    .top_datetime2{
        padding-left: 40px !important;
    }
    .top_date_row2{
        color: white;
        font-size: 16px;
    }
    .profile_img_top2{
        border-radius: 100px;
        width: 40px;
        height: 40px;
        margin-right: 50px;
        border:2px solid white;
        margin-top: 2px !important;
        object-fit: cover;
    }
    .top_time_row2{
        color: rgba(255, 255, 255, 0.719);
        font-size: 14px;
    }
</style>
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

        <!-- content -->
        <!-- @include('inc.messages') -->
        @yield('content')
    </div>

    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!--/jquery-->

    <!--Javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <!--/script-->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- custom scrollbar plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

</body>
</html>