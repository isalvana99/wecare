<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../style/navstyle3.css" rel="stylesheet" type="text/css" >
    <link href="../../style/socialmediabuttons.css" rel="stylesheet" type="text/css" >
    <link rel="shortcut icon" href="{{ asset('images/wecarelogo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    <title>WeCare</title>
</head>
<body>
@php date_default_timezone_set("Asia/Manila"); @endphp
    <!-- top nav here -->
    <div class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-fixed-top" id="navbar">
            <a class="navbar-brand" id="navlogo" href="/home">
                        <img src="../../images/wecarelogo.png" alt="">   
                        <img src="../../images/wecaretitle.png" alt="">                          
                    </a>
            <button class="navbar-toggler custom-toggler" id="burgerbtn" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon "></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent"> <!--start of nav div-->

                <form class="form-inline my-2 mx-auto" id="navform" action="{{ route('search') }}" method="GET">
                <i class="fal fa-search"></i> 
                <input class="form-control mr-sm-2 searchnav" type="search" placeholder="Search" aria-label="Search" name="search" onclick="submit_form()" value="{{$search}}">
                </form>

                <div class="row nav-item dropdown" >
                    <div class="col" style="width:50px;">
                        <img src="/storage/profile_images/{{Auth::user()->profileImage}}" alt="" class="imagecon2">
                        @if(count($notification) > 0)
                        @foreach($notification as $var)
                        @if($var->notifStatus == "UNREAD")
                            @if($var->notifUserId != Auth::user()->id)
                            <div class="circle_alert3"></div>
                            @elseif($var->notifUserId == Auth::user()->id && $var->notifType == "welcome")
                            <div class="circle_alert3"></div>
                            @elseif($var->notifUserId == Auth::user()->id && $var->notifType == "verify")
                            <div class="circle_alert3"></div>
                            @endif
                        @break
                        @elseif($var->notifStatus == "READ" && $var->notifUserId != Auth::user()->id)
                        @endif
                        @endforeach
                        @endif
                    </div>

                    <div class="col" style="margin-right:5px;">
                        <a id="navdropdown" style="margin-left:-20px;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{Auth::user()->firstName." ".Auth::user()->orgName}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="right: 30px;left: auto;">
                        <a class="dropdown-item" href="/users/profile/{{Auth::user()->id}}">Profile</a>
                        <a class="dropdown-item" href="/activity/you-donated">Transaction History</a>
                        <a class="dropdown-item" href="/users/{{Auth::user()->id}}/edit">Update My Information</a>
                        <div class="dropdown-item" data-toggle="modal" data-target="#notifModal" style="cursor:pointer;">
                        @if(count($notification) > 0)
                        @foreach($notification as $var)
                        @if($var->notifStatus == "UNREAD")
                            @if($var->notifUserId != Auth::user()->id)
                            <div class="circle_alert"></div>
                            @elseif($var->notifUserId == Auth::user()->id && $var->notifType == "welcome")
                            <div class="circle_alert"></div>
                            @elseif($var->notifUserId == Auth::user()->id && $var->notifType == "verify")
                            <div class="circle_alert"></div>
                            @endif
                        @break
                        @elseif($var->notifStatus == "READ" && $var->notifUserId != Auth::user()->id)
                        @endif
                        @endforeach
                        @endif

                        Notification</div>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        </div>
                    </div>
                    
                </div>


                <div class="smallmenu"><!--only show in smal screen-->
                <ul class="navbar-nav" >
                    <li class="nav-item dropdown" >
                        <label for="" class="lblmenu"><a style="color:white;" href="/users/profile/{{Auth::user()->id}}">Profile</a></label>
                    </li>
                    <li class="nav-item dropdown" >
                        <label for="" class="lblmenu"><a style="color:white;" href="/activity/you-donated">Transaction History</a></label>
                    </li>
                    <li class="nav-item dropdown" >
                        <label for="" class="lblmenu"><a style="color:white;" href="/users/{{Auth::user()->id}}/edit">Update My Information</a></label>
                    </li>
                    <li class="nav-item dropdown">
                        <label for="" class="lblmenu">
                        <div data-toggle="modal" data-target="#notifModal" style="cursor:pointer;">
                            @if(count($notification) > 0)
                            @foreach($notification as $var)
                            @if($var->notifStatus == "UNREAD")
                                @if($var->notifUserId != Auth::user()->id)
                                <div class="circle_alert2"></div>
                                @elseif($var->notifUserId == Auth::user()->id && $var->notifType == "welcome")
                                <div class="circle_alert2"></div>
                                @elseif($var->notifUserId == Auth::user()->id && $var->notifType == "verify")
                                <div class="circle_alert2"></div>
                                @endif
                            @break
                            @elseif($var->notifStatus == "READ" && $var->notifUserId != Auth::user()->id)
                            @endif
                            @endforeach
                            @endif
                            
                            Notification
                        </div>
                        </label>
                    </li>
                    <li class="nav-item dropdown" >
                        <label for="" class="lblmenu">
                        <a style="color:white;" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        </label>
                    </li>
                </ul>
                </div>

            </div><!--end of nav div-->
        </nav>
    </div>
    <!-- /top nav -->
    
    <div class="outer_post_con" >
        <div class="row outer_row_con">
            <!-- @include('inc.messages') -->
            @yield('content')
        </div>
    </div>
    <!-- create post end -->

    <!-- notif modal -->
    <div class="modal fade" id="notifModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @if(count($notification) > 0)
                    @foreach($notification as $var)
                    @if($var->notifStatus == "UNREAD")
                        @if($var->notifUserId != Auth::user()->id)
                        <form action="{{route('thisnotif')}}" method="GET">
                            <input type="hidden" name="me" value="{{Auth::user()->id}}">
                            <button class="notifbtn" type="submit"><i class="fa fa-check" aria-hidden="true" style="position:relative;"></i> Mark All As Read </button>
                        </form>
                        @elseif($var->notifUserId == Auth::user()->id && $var->notifType == "welcome")
                        <form action="{{route('thisnotif')}}" method="GET">
                            <input type="hidden" name="me" value="{{Auth::user()->id}}">
                            <button class="notifbtn" type="submit"><i class="fa fa-check" aria-hidden="true" style="position:relative;"></i> Mark All As Read </button>
                        </form>
                        @elseif($var->notifUserId == Auth::user()->id && $var->notifType == "verify")
                        <form action="{{route('thisnotif')}}" method="GET">
                            <input type="hidden" name="me" value="{{Auth::user()->id}}">
                            <button class="notifbtn" type="submit"><i class="fa fa-check" aria-hidden="true" style="position:relative;"></i> Mark All As Read </button>
                        </form>
                        @endif
                    @break
                    @elseif($var->notifStatus == "READ")
                        @if($var->notifUserId != Auth::user()->id)
                        <button class="notifbtn2" type="submit"><i class="fa fa-check" aria-hidden="true" style=""></i> Mark All As Read </button>
                        @elseif($var->notifUserId == Auth::user()->id && $var->notifType == "welcome")
                        <button class="notifbtn2" type="submit"><i class="fa fa-check" aria-hidden="true" style=""></i> Mark All As Read </button>
                        @elseif($var->notifUserId == Auth::user()->id && $var->notifType == "verify")
                        <button class="notifbtn2" type="submit"><i class="fa fa-check" aria-hidden="true" style=""></i> Mark All As Read </button>
                        @endif
                    @break
                    @endif
                    @endforeach
                    @endif
                </div>

                <div class="modal-body">
                
                <table>
                    <tr>
                        <th>Notifications</th>
                    </tr>

                    @if(count($notification) > 0)
                    @foreach($notification as $var)
                    <tr>
                        @if($var->notifStatus == "UNREAD")
                            @if($var->notifUserId != Auth::user()->id)
                            <td style="background-color:#dfdfdf !important;font-weight: bold;">
                                @if($var->notifType != "followed" && $var->notifType != "assigned")
                                <a class="notiflinks" href="/users/profile/{{$var->notifUserId}}">{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</a>
                                
                                {{$var->notifType}}
                                
                                on your <a class="notiflinks" href="/home/{{$var->notifPostId}}">post</a>
                                @elseif($var->notifType != "followed" && $var->notifType == "assigned")
                                
                                <a class="notiflinks" href="/users/profile/{{$var->notifUserId}}">{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</a>
                                
                                {{$var->notifType}}
                                
                                you a <a class="notiflinks" href="/distribution/my">task.</a>
                                @else
                                <a class="notiflinks" href="/users/profile/{{$var->notifUserId}}">{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</a>
                                
                                {{$var->notifType}}
                                
                                you
                                @endif
                                <small>
                                (@php
                                date_default_timezone_set("Asia/Manila");
                                $today = date("Y-m-d H:i:s");
                                $date1 = strtotime(date("Y-m-d H:i:s"));
                                $date2 = strtotime($var->notifCreatedAt);
                                
                                $diff = abs($date2 - $date1);
                                
                                $years = floor($diff / (365*60*60*24));
                                
                                $months = floor(($diff - $years * 365*60*60*24)
                                                                / (30*60*60*24));
                                
                                $days = floor(($diff - $years * 365*60*60*24 -
                                            $months*30*60*60*24)/ (60*60*24));
                                
                                $hours = floor(($diff - $years * 365*60*60*24
                                        - $months*30*60*60*24 - $days*60*60*24)
                                                                    / (60*60));
                                
                                $minutes = floor(($diff - $years * 365*60*60*24
                                        - $months*30*60*60*24 - $days*60*60*24
                                                            - $hours*60*60)/ 60);
                                
                                $seconds = floor(($diff - $years * 365*60*60*24
                                        - $months*30*60*60*24 - $days*60*60*24
                                                - $hours*60*60 - $minutes*60));
                                
                                // Print the result
                                if($days == 0){
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
                                }else if($days == 1){
                                    echo $days." day ago";
                                }else if($days < 7 && $days > 0){
                                    echo $days." days ago";
                                }else{
                                    echo date('F j, Y', strtotime($var->notifCreatedAt));
                                }

                                @endphp)</small>
                            </td>
                            @elseif($var->notifUserId == Auth::user()->id && $var->notifType == "welcome")
                            <td style="background-color:#dfdfdf !important;font-weight: bold;">
                                
                                Welcome to WeCare, {{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}

                                <small>
                                (@php
                                    date_default_timezone_set("Asia/Manila");
                                    $today = date("Y-m-d H:i:s");
                                    $date1 = strtotime(date("Y-m-d H:i:s"));
                                    $date2 = strtotime($var->notifCreatedAt);
                                    
                                    $diff = abs($date2 - $date1);
                                    
                                    $years = floor($diff / (365*60*60*24));
                                    
                                    $months = floor(($diff - $years * 365*60*60*24)
                                                                    / (30*60*60*24));
                                    
                                    $days = floor(($diff - $years * 365*60*60*24 -
                                                $months*30*60*60*24)/ (60*60*24));
                                    
                                    $hours = floor(($diff - $years * 365*60*60*24
                                            - $months*30*60*60*24 - $days*60*60*24)
                                                                        / (60*60));
                                    
                                    $minutes = floor(($diff - $years * 365*60*60*24
                                            - $months*30*60*60*24 - $days*60*60*24
                                                                - $hours*60*60)/ 60);
                                    
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
                                        echo date('F j, Y', strtotime($var->notifCreatedAt));
                                    }

                                    @endphp)</small>
                            </td>
                            @elseif($var->notifUserId == Auth::user()->id && $var->notifType == "verify" && $var->notifPostId == NULL)
                            <td style="background-color:#dfdfdf !important;font-weight: bold;">
                                
                                Your account is now verified!

                                <small>
                                (@php
                                date_default_timezone_set("Asia/Manila");
                                $today = date("Y-m-d H:i:s");
                                $date1 = strtotime(date("Y-m-d H:i:s"));
                                $date2 = strtotime($var->notifCreatedAt);
                                
                                $diff = abs($date2 - $date1);
                                
                                $years = floor($diff / (365*60*60*24));
                                
                                $months = floor(($diff - $years * 365*60*60*24)
                                                                / (30*60*60*24));
                                
                                $days = floor(($diff - $years * 365*60*60*24 -
                                            $months*30*60*60*24)/ (60*60*24));
                                
                                $hours = floor(($diff - $years * 365*60*60*24
                                        - $months*30*60*60*24 - $days*60*60*24)
                                                                    / (60*60));
                                
                                $minutes = floor(($diff - $years * 365*60*60*24
                                        - $months*30*60*60*24 - $days*60*60*24
                                                            - $hours*60*60)/ 60);
                                
                                $seconds = floor(($diff - $years * 365*60*60*24
                                        - $months*30*60*60*24 - $days*60*60*24
                                                - $hours*60*60 - $minutes*60));
                                
                                // Print the result
                                if($days == 0){
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
                                }else if($days == 1){
                                    echo $days." day ago";
                                }else if($days < 7 && $days > 0){
                                    echo $days." days ago";
                                }else{
                                    echo date('F j, Y', strtotime($var->notifCreatedAt));
                                }

                                @endphp)</small>
                            </td>
                            @elseif($var->notifUserId == Auth::user()->id && $var->notifType == "verify" && $var->notifPostId != NULL)
                            <td style="background-color:#dfdfdf !important;font-weight: bold;">
                                
                                Your <a class="notiflinks" href="/home/{{$var->notifPostId}}">post</a> has been approved, you can now receive donations.

                                <small>
                                (@php
                                date_default_timezone_set("Asia/Manila");
                                $today = date("Y-m-d H:i:s");
                                $date1 = strtotime(date("Y-m-d H:i:s"));
                                $date2 = strtotime($var->notifCreatedAt);
                                
                                $diff = abs($date2 - $date1);
                                
                                $years = floor($diff / (365*60*60*24));
                                
                                $months = floor(($diff - $years * 365*60*60*24)
                                                                / (30*60*60*24));
                                
                                $days = floor(($diff - $years * 365*60*60*24 -
                                            $months*30*60*60*24)/ (60*60*24));
                                
                                $hours = floor(($diff - $years * 365*60*60*24
                                        - $months*30*60*60*24 - $days*60*60*24)
                                                                    / (60*60));
                                
                                $minutes = floor(($diff - $years * 365*60*60*24
                                        - $months*30*60*60*24 - $days*60*60*24
                                                            - $hours*60*60)/ 60);
                                
                                $seconds = floor(($diff - $years * 365*60*60*24
                                        - $months*30*60*60*24 - $days*60*60*24
                                                - $hours*60*60 - $minutes*60));
                                
                                // Print the result
                                if($days == 0){
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
                                }else if($days == 1){
                                    echo $days." day ago";
                                }else if($days < 7 && $days > 0){
                                    echo $days." days ago";
                                }else{
                                    echo date('F j, Y', strtotime($var->notifCreatedAt));
                                }

                                @endphp)</small>
                            </td>
                            @endif

                        @elseif($var->notifStatus == "READ")
                            @if($var->notifUserId != Auth::user()->id)
                                <td style="background-color: white;">
                                    @if($var->notifType != "followed" && $var->notifType != "assigned")
                                    <a class="notiflinks" href="/users/profile/{{$var->notifUserId}}">{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</a>
                                    
                                    {{$var->notifType}}
                                    
                                    on your <a class="notiflinks" href="/home/{{$var->notifPostId}}">post</a>
                                    @elseif($var->notifType != "followed" && $var->notifType == "assigned")
                                    
                                    <a class="notiflinks" href="/users/profile/{{$var->notifUserId}}">{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</a>
                                    
                                    {{$var->notifType}}
                                    
                                    you a <a class="notiflinks" href="/distribution/my">task.</a>
                                    @else
                                    <a class="notiflinks" href="/users/profile/{{$var->notifUserId}}">{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</a>
                                    
                                    {{$var->notifType}}
                                    
                                    you
                                    @endif
                                    <small>
                                    (@php
                                    date_default_timezone_set("Asia/Manila");
                                    $today = date("Y-m-d H:i:s");
                                    $date1 = strtotime(date("Y-m-d H:i:s"));
                                    $date2 = strtotime($var->notifCreatedAt);
                                    
                                    $diff = abs($date2 - $date1);
                                    
                                    $years = floor($diff / (365*60*60*24));
                                    
                                    $months = floor(($diff - $years * 365*60*60*24)
                                                                    / (30*60*60*24));
                                    
                                    $days = floor(($diff - $years * 365*60*60*24 -
                                                $months*30*60*60*24)/ (60*60*24));
                                    
                                    $hours = floor(($diff - $years * 365*60*60*24
                                            - $months*30*60*60*24 - $days*60*60*24)
                                                                        / (60*60));
                                    
                                    $minutes = floor(($diff - $years * 365*60*60*24
                                            - $months*30*60*60*24 - $days*60*60*24
                                                                - $hours*60*60)/ 60);
                                    
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
                                        echo date('F j, Y', strtotime($var->notifCreatedAt));
                                    }

                                    @endphp)</small>
                                </td>
                            @elseif($var->notifUserId == Auth::user()->id && $var->notifType == "welcome")
                                <td style="background-color: white;">
                                    
                                    Welcome to WeCare, {{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}

                                    <small>
                                    (@php
                                    date_default_timezone_set("Asia/Manila");
                                    $today = date("Y-m-d H:i:s");
                                    $date1 = strtotime(date("Y-m-d H:i:s"));
                                    $date2 = strtotime($var->notifCreatedAt);
                                    
                                    $diff = abs($date2 - $date1);
                                    
                                    $years = floor($diff / (365*60*60*24));
                                    
                                    $months = floor(($diff - $years * 365*60*60*24)
                                                                    / (30*60*60*24));
                                    
                                    $days = floor(($diff - $years * 365*60*60*24 -
                                                $months*30*60*60*24)/ (60*60*24));
                                    
                                    $hours = floor(($diff - $years * 365*60*60*24
                                            - $months*30*60*60*24 - $days*60*60*24)
                                                                        / (60*60));
                                    
                                    $minutes = floor(($diff - $years * 365*60*60*24
                                            - $months*30*60*60*24 - $days*60*60*24
                                                                - $hours*60*60)/ 60);
                                    
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
                                        echo date('F j, Y', strtotime($var->notifCreatedAt));
                                    }

                                    @endphp)</small>
                                </td>
                            @elseif($var->notifUserId == Auth::user()->id && $var->notifType == "verify"  && $var->notifPostId == NULL)
                                <td style="background-color: white;">
                                    
                                Your account is now verified!

                                    <small>
                                    (@php
                                    date_default_timezone_set("Asia/Manila");
                                    $today = date("Y-m-d H:i:s");
                                    $date1 = strtotime(date("Y-m-d H:i:s"));
                                    $date2 = strtotime($var->notifCreatedAt);
                                    
                                    $diff = abs($date2 - $date1);
                                    
                                    $years = floor($diff / (365*60*60*24));
                                    
                                    $months = floor(($diff - $years * 365*60*60*24)
                                                                    / (30*60*60*24));
                                    
                                    $days = floor(($diff - $years * 365*60*60*24 -
                                                $months*30*60*60*24)/ (60*60*24));
                                    
                                    $hours = floor(($diff - $years * 365*60*60*24
                                            - $months*30*60*60*24 - $days*60*60*24)
                                                                        / (60*60));
                                    
                                    $minutes = floor(($diff - $years * 365*60*60*24
                                            - $months*30*60*60*24 - $days*60*60*24
                                                                - $hours*60*60)/ 60);
                                    
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
                                        echo date('F j, Y', strtotime($var->notifCreatedAt));
                                    }

                                    @endphp)</small>
                                </td>
                            @elseif($var->notifUserId == Auth::user()->id && $var->notifType == "verify"  && $var->notifPostId != NULL)
                                <td style="background-color: white;">
                                    
                                Your <a class="notiflinks" href="/home/{{$var->notifPostId}}">post</a> has been approved, you can now receive donations.

                                    <small>
                                    (@php
                                    date_default_timezone_set("Asia/Manila");
                                    $today = date("Y-m-d H:i:s");
                                    $date1 = strtotime(date("Y-m-d H:i:s"));
                                    $date2 = strtotime($var->notifCreatedAt);
                                    
                                    $diff = abs($date2 - $date1);
                                    
                                    $years = floor($diff / (365*60*60*24));
                                    
                                    $months = floor(($diff - $years * 365*60*60*24)
                                                                    / (30*60*60*24));
                                    
                                    $days = floor(($diff - $years * 365*60*60*24 -
                                                $months*30*60*60*24)/ (60*60*24));
                                    
                                    $hours = floor(($diff - $years * 365*60*60*24
                                            - $months*30*60*60*24 - $days*60*60*24)
                                                                        / (60*60));
                                    
                                    $minutes = floor(($diff - $years * 365*60*60*24
                                            - $months*30*60*60*24 - $days*60*60*24
                                                                - $hours*60*60)/ 60);
                                    
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
                                        echo date('F j, Y', strtotime($var->notifCreatedAt));
                                    }

                                    @endphp)</small>
                                </td>
                            @endif
                        @endif
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td>Empty</td>
                    </tr>
                    @endif
                </table>
                
                </div>
            </div>
        </div>
    </div>
    <!-- /notif modal -->

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
    $(document).ready( function() {
    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {
		    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
	    
		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#imgInp").change(function(){
		    readURL(this);
		}); 	
	});
</script>

<script>
        function myFunction() {
            var selectedCity = document.getElementById("selectedCity").value;
            var mandaue = document.getElementById("city1");
            var lapu = document.getElementById("city2");
            var none = document.getElementById("city0");
            document.getElementById("citt").value=selectedCity;
            document.getElementById("barr").value="";

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
            } else if (selectedCity == "none"){
                mandaue.style.display = "none";
                lapu.style.display = "none";
                none.style.display = "block";
                document.getElementById("city0").value = 'Select City';
            }
        }
    </script>

<!-- loop posts from array -->
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

<script type="text/javascript">
    
    function getBarangay1(){

        var barangay1 = document.getElementById('city1').value;

        document.getElementById("barr").value=barangay1;
    }

    function getBarangay2(){

        var barangay2 = document.getElementById('city2').value;

        document.getElementById("barr").value=barangay2;
    }

    

</script>

<script>
    var bar = document.getElementById('selectedCity').value;
    var mandaue = document.getElementById("city1");
    var lapu = document.getElementById("city2");
    var none = document.getElementById("city0");

    if(bar.value!=""){
        if (bar=="Mandaue")
        {
            mandaue.style.display = "block";
            none.style.display = "none";
                    
        }else if (bar=="Lapu-Lapu"){
            lapu.style.display = "block";
            none.style.display = "none";
        }
    }
    

    document.getElementById('test').value=barangay1;
</script>
<script>
    $(document).ready(function() {  
    // check where the shoppingcart-div is  
    var offset = $('#shopping-cart').offset();  
    $(window).scroll(function () {    
        var scrollTop = $(window).scrollTop(); 
        // check the visible top of the browser     
        if (offset.top<scrollTop) {
            $('#shopping-cart').addClass('left_panel_con'); 
        } else {
            $('#shopping-cart').removeClass('left_panel_con');   
        }
    }); 
}); 
</script>

<script>
$(document).ready( function() {
    $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
    
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

        $("#imgInp").change(function(){
            readURL(this);
        }); 	
    });
</script>
</body>
</html>