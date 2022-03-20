<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/style/fontfamily.css" rel="stylesheet" type="text/css" >
    <link href="/style/poststyles3.css" rel="stylesheet" type="text/css" >
    <link rel="shortcut icon" href="{{ asset('images/wecarelogo.png') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>WeCare</title>
</head>
<body>
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
      <i class="fa fa-search fa-lg" aria-hidden="true"></i>   
      <input class="form-control mr-sm-2 searchnav" type="search" placeholder="Search" name="search" onclick="submit_form()" aria-label="Search" value="">
    </form>

    <!-- dropdown navbar -->
      <ul class="navbar-nav mr-5">
        <li class="nav-item dropdown" >
          <a id="navdropdown" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img class="imagecon2" src="/storage/profile_images/{{Auth::user()->profileImage}}" alt="">
          @if(count($notification) > 0)
          @foreach($notification as $var)
          @if($var->notifStatus == "UNREAD" && $var->notifUserId != Auth::user()->id)
          <div class="circle_alert3" style="margin-left: 25px;margin-top:-35px;"></div>
          @break
          @elseif($var->notifStatus == "READ" && $var->notifUserId != Auth::user()->id)
          @endif
          @endforeach
          @endif

          @if(count($notification) > 0)
        @foreach($notification as $var)
        @if($var->notifStatus == "UNREAD")
            @if($var->notifUserId != Auth::user()->id)
            <div class="circle_alert3" style="margin-left: 25px;margin-top:-35px;"></div>
            @elseif($var->notifUserId == Auth::user()->id && $var->notifType == "welcome")
            <div class="circle_alert3" style="margin-left: 25px;margin-top:-35px;"></div>
            @elseif($var->notifUserId == Auth::user()->id && $var->notifType == "verify")
            <div class="circle_alert3" style="margin-left: 25px;margin-top:-35px;"></div>
            @endif
        @break
        @elseif($var->notifStatus == "READ" && $var->notifUserId != Auth::user()->id)
        @endif
        @endforeach
        @endif

          {{Auth::user()->firstName." ".Auth::user()->orgName}}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="right: 0px;left: auto;">
            <a class="dropdown-item" href="/users/profile/{{Auth::user()->id}}">Profile</a>
            <a class="dropdown-item" href="/activity/you-donated">Transaction History</a>
            <a class="dropdown-item" href="/users/{{Auth::user()->id}}/edit">Update Credentials</a>
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
        </li>
      </ul>
      <!--end dropdown navbar -->


      <div class="smallmenu"><!--only show in smal screen-->
      <ul class="navbar-nav" >
        <li class="nav-item dropdown" >
            <label for="" class="lblmenu">Profile</label>
        </li>
        <li class="nav-item dropdown" >
            <label for="" class="lblmenu">Transaction History</label>
        </li>
        <li class="nav-item dropdown" >
            <label for="" class="lblmenu">Update Credentials</label>
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
            <label for="" class="lblmenu">Log out</label>
        </li>
      </ul>
    </div>

  </div><!--end of nav div-->

  
</nav>
</div>

<div class="part2">

@yield('content')
</div>

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
                            @if($var->notifType != "followed")
                            <a class="notiflinks" href="/users/profile/{{$var->notifToUserId}}">{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</a>
                            
                            {{$var->notifType}}
                            
                            on your <a class="notiflinks" href="/home/{{$var->notifPostId}}">post</a>
                            @else
                            <a class="notiflinks" href="/users/profile/{{$var->notifToUserId}}">{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</a>
                            
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
                                @if($var->notifType != "followed")
                                <a class="notiflinks" href="/users/profile/{{$var->notifToUserId}}">{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</a>
                                
                                {{$var->notifType}}
                                
                                on your <a class="notiflinks" href="/home/{{$var->notifPostId}}">post</a>
                                @else
                                <a class="notiflinks" href="/users/profile/{{$var->notifToUserId}}">{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</a>
                                
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

    <script>
    function submit_form(){
        var form = document.getElementById("my_form");
        form.submit();
        alert("Your Message Sent");
    }
    </script>

</body>
</html>