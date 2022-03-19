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
                        @if($var->notifStatus == "UNREAD" && $var->notifUserId != Auth::user()->id)
                        <div class="circle_alert3"></div>
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
                        <a class="dropdown-item" href="/users/{{Auth::user()->id}}/edit">Update Credentials</a>
                        <div class="dropdown-item" data-toggle="modal" data-target="#notifModal" style="cursor:pointer;">
                        @if(count($notification) > 0)
                        @foreach($notification as $var)
                        @if($var->notifStatus == "UNREAD" && $var->notifUserId != Auth::user()->id)
                        <div class="circle_alert"></div>
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
                        <label for="" class="lblmenu"><a style="color:white;" href="/users/{{Auth::user()->id}}/edit">Update Credentials</a></label>
                    </li>
                    <li class="nav-item dropdown">
                    <label for="" class="lblmenu">
                        <div data-toggle="modal" data-target="#notifModal" style="cursor:pointer;">
                            @if(count($notification) > 0)
                            @foreach($notification as $var)
                            @if($var->notifStatus == "UNREAD"  && $var->notifUserId != Auth::user()->id)
                            <div class="circle_alert2"></div>
                            @break
                            @elseif($var->notifStatus == "READ"  && $var->notifUserId != Auth::user()->id)
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


    <!-- notif modal -->
    <div class="modal fade" id="notifModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                @if(count($notification) > 0)
                @foreach($notification as $var)
                @if($var->notifStatus == "UNREAD" && $var->notifUserId != Auth::user()->id)
                <form action="{{route('thisnotif')}}" method="GET">
                    <input type="hidden" name="me" value="{{Auth::user()->id}}">
                    <button class="notifbtn" type="submit"><i class="fa fa-check" aria-hidden="true" style="position:relative;"></i> Mark All As Read </button>
                </form>
                @break
                @elseif($var->notifStatus == "READ" && $var->notifUserId != Auth::user()->id)
                <button class="notifbtn2" type="submit"><i class="fa fa-check" aria-hidden="true" style=""></i> Mark All As Read </button>
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
                    @if($var->notifStatus == "UNREAD" && $var->notifUserId != Auth::user()->id)
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
                    @elseif($var->notifStatus == "READ" && $var->notifUserId != Auth::user()->id)
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