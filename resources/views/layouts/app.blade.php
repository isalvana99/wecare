<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/x-icon" href="images/wecarelogo.png"/>
    <title>WeCare</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/homecss.css') }}" rel="stylesheet">
    <link href="{{ asset('style/main.css') }}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style2.css">
    <link href="{{ asset('style/reactionbuttons.css') }}" rel="stylesheet" type="text/css" >
</head>
<body>
    
                <nav class="navbar navbar-expand-md">
                    <!-- Left Side Of Navbar -->
                    @guest
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="images/wecarelogo.png" alt="">   
                        <img src="images/wecaretitle.png" alt="">                          
                    </a>
                    @else
                    <a class="navbar-brand" href="{{ url('/pages/home') }}">
                        <img src="images/wecarelogo.png" alt="">   
                        <img src="images/wecaretitle.png" alt="">                          
                    </a>
                    @endguest
                    <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#main-navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>


                    <div class="collapse navbar-collapse" id="main-navigation">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/about">About</a>
                            </li>

                            @guest
                                @if (Route::has('login'))
                                <li class="nav-item" id="con1">
                                    <a class="nav-link" href="{{ route('login') }}" id="btn-grp1" style="padding-left:20px; padding-right:20px;">Login</a>
                                </li>
                                @endif

                                @if (Route::has('register'))
                                <li class="nav-item" id="con1">
                                    <a class="nav-link" href="{{ route('register') }}" id="btn-grp1" style="padding-left:15px; padding-right:15px;">Register</a>
                                </li>
                                @endif 
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->firstname." ".Auth::user()->lastname }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/users/{{Auth::user()->id}}"
                                        >
                                            {{ __('Profile') }}
                                        </a>

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
                            @endguest
                        </ul>
                    </div>
                </nav>

                <!--Wave-->
                <div class="container1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="svg1">
                    <path fill="#64c7fe" fill-opacity="1" d="M0,160L21.8,149.3C43.6,139,87,117,131,122.7C174.5,128,218,160,262,160C305.5,160,349,128,393,117.3C436.4,107,480,117,524,149.3C567.3,181,611,235,655,256C698.2,277,742,267,785,234.7C829.1,203,873,149,916,133.3C960,117,1004,139,1047,176C1090.9,213,1135,267,1178,256C1221.8,245,1265,171,1309,117.3C1352.7,64,1396,32,1418,16L1440,0L1440,0L1418.2,0C1396.4,0,1353,0,1309,0C1265.5,0,1222,0,1178,0C1134.5,0,1091,0,1047,0C1003.6,0,960,0,916,0C872.7,0,829,0,785,0C741.8,0,698,0,655,0C610.9,0,567,0,524,0C480,0,436,0,393,0C349.1,0,305,0,262,0C218.2,0,175,0,131,0C87.3,0,44,0,22,0L0,0Z">
                    </path></svg>
                </div>
                <!--/Wave-->
        <main class="py-4 container2">
            @include('inc.messages')
            @yield('content')
        </main>

    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!--/jquery-->
    
    

</body>
</html>
